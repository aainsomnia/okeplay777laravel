<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Image;
use File;

use App\Models\Bn_Banner;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.index');
    }

    public function get(Request $request)
    {
        $param = $request->get("columns");
        $search = [];
        if(count($param) > 0){
           foreach($param as $item){
                $key = $item['data'];
                $value = $item['search']['value'];
                if(!empty($value)){
                   array_push($search, [$key, 'like' , '%'.$value.'%']);
                }
            }
        }

        $col = ['banner_img','banner_created','banner_id'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $banner = Bn_Banner::select($col)->where($search)->orderBy($sort['col'], $sort['dir']);
        $total = $banner->count('banner_id');
        $data = $banner->skip($start)->limit($limit)->get();

        if(!empty($data)) {
            foreach ($data as $keys => $dt) {
                $banner_img_link = URL::to('storage/images/banner/'.$dt->banner_img);
                $dt['banner_img'] = '<img src="'.$banner_img_link.'" width="90px" />';
                $dt['action'] = '<button type="button" class="btn btn-danger btn-sm btn_delete" data-id="'.$dt->banner_id.'">Delete</button>';
            }
        }

        $response = ['recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => intval($request->input('draw')), 'data' => $data];
        return response()->json($response, 200);
    }

    public function store_image(Request $request)
    {
        $file = $request->file("file");
        $extension = $file->extension();
        $name_original = $file->getClientOriginalName();
        $url_file = "";
        $file_name = "";

        if ($file) {
            $file_name = "BN_".time().".".$extension;
            $path = storage_path().'/app/public/images/banner/';
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file->move($path, $file_name);
        }

        $res = array(
            "success" => 1,
            "message" => "Successfully upload image.",
            "ext" => strtoupper($extension),
            "url_file" => URL::asset("storage/images/banner/".$file_name),
            "file_name" => $file_name,
            "name_original" => $name_original
        );

        return response()->json($res);
    }

    public function delete_image(Request $request)
    {
        $param = $request->all();

        $delete = public_path().'/storage/images/banner/'.$param['file_name'];
        unlink($delete);

        $response = array(
            "success" => 1,
            "message" => "Successfully delete image.",
            "file_name" => $param['file_name']
        );

        return response()->json($param['file_name']);
    }

    public function store(Request $request)
    {
        $post = $request->only('banner_img');

        if($request->filled('banner_img') && count($request->get("banner_img")) > 0) {
            foreach ($post['banner_img'] as $banner_img) {
                $post_attachment_img = array(
                    "banner_img" => $banner_img,
                    "banner_created" => date('Y-m-d H:i:s'),
                );
                Bn_Banner::create($post_attachment_img);
            }
        } else {
            return response()->json(['message' => 'Banner image required'], 500);
        }
    }

    public function destroy($banner_id)
    {
        $data = Bn_Banner::where('banner_id', $banner_id)->first();

        if ($data == true) {
            if ($data->banner_img != null) {
                $del_cover = $data->banner_img;
                Storage::disk('banner')->delete('images/banner/'.$del_cover);
            }

            $data->delete();

            return response()->json(['success' => 1, 'message' => 'Delete banner succesfully.', 'data' => $data], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'Failed to delete banner.', 'data' => []], 404);
        }
    }
}
