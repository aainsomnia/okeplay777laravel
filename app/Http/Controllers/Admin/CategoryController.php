<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Image;
use File;

use App\Models\Ct_Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function get(Request $request)
    {
        $param = $request->get("columns");
        $search = [];
        if(count($param) > 0){
           foreach($param as $item){
                $key = $item['data'];
                $value = $item['search']['value'];
                if(!empty($value) && $key != 'game_url_link'){
                   array_push($search, [$key, 'like' , '%'.$value.'%']);
                }
            }
        }

        $req_game_url = $request->input('columns.2.search.value');
        $col = ['category_img','category_name','game_url','category_id'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $category = Ct_Category::select($col)->where($search)
                    ->when($req_game_url != '', function($query) use($req_game_url){
                        $query->where('game_url', 'like', '%'.$req_game_url.'%');
                    })
                    ->orderBy($sort['col'], $sort['dir']);
        $total = $category->count('category_id');
        $data = $category->skip($start)->limit($limit)->get();

        if(!empty($data)) {
            foreach ($data as $keys => $dt) {
                $category_img_link = URL::to('storage/images/category/'.$dt->category_img);
                $dt['category_img'] = '<img src="'.$category_img_link.'" width="90px" />';
                $dt['category_name'] = $dt->category_name;
                $dt['game_url'] = $dt->game_url;
                $dt['game_url_link'] = $dt->game_url ? '<a href="'.$dt->game_url.'">'.$dt->game_url.'</a>' : '-';
                $dt['action'] = '
                    <button type="button" class="btn btn-primary btn-sm btn_edit" data-toggle="modal" data-target="#exampleModal" data-img_link="'.$category_img_link.'">Edit</button>&nbsp;
                    <button type="button" class="btn btn-danger btn-sm btn_delete" data-id="'.$dt->category_id.'">Delete</button>
                ';
            }
        }

        $response = ['recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => intval($request->input('draw')), 'data' => $data];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $post = $request->all();
        $validator = Validator::make($post, [
            'category_img' => 'required',
            'category_name' => 'required',
            'category_img' => 'required',
            'game_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $file = $request->file('category_img');
        $cover = null;
        if ($file) {
            $extension = $file->extension();
            $cover = "CT_".time().".".$extension;
            $path = storage_path().'/app/public/images/category/';
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file->move($path, $cover);
            $post['category_img'] = $cover;
        }

        $post['category_created'] = date('Y-m-d H:i:s');
        $store = Ct_Category::create($post);
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $data = Ct_Category::where('category_id', $post['id'])->first();

        if ($data != true) {
            return response()->json(['message' => 'ID category not found.'], 404);
        }

        $post = $request->all();
        $validator = Validator::make($post, [
            'category_img' => 'required',
            'category_name' => 'required',
            'category_img' => 'required',
            'game_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $file = $request->file('category_img');
        if ($file) {
            Storage::disk('category')->delete($data->category_img);
            $extension = $file->extension();
            $cover = "CT_".time().".".$extension;
            $path = storage_path().'/app/public/images/category/';
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file->move($path, $cover);
            $post['category_img'] = $cover;
        } else {
            $cover = $data->category_img;
            $post['category_img'] = $cover;
        }

        $post['category_updated'] = date('Y-m-d H:i:s');
        $data->update($post);
    }

    public function destroy($category_id)
    {
        $data = Ct_Category::where('category_id', $category_id)->first();

        if ($data == true) {
            if ($data->category_img != null) {
                $del_cover = $data->category_img;
                Storage::disk('category')->delete($del_cover);
            }

            $data->delete();

            return response()->json(['success' => 1, 'message' => 'Delete category succesfully.', 'data' => $data], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'Failed to delete category.', 'data' => []], 404);
        }
    }
}
