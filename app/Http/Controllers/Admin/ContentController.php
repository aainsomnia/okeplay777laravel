<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Image;
use File;

use App\Models\Ct_Content;
use App\Models\Ct_Category;

class ContentController extends Controller
{
    public function index()
    {
        $category = Ct_Category::orderBy('category_name', 'ASC')->get();
        $content = Ct_Content::orderBy('content_index', 'ASC')->get();

        return view('admin.content.index', compact('category','content'));
    }

    public function get(Request $request)
    {
        $param = $request->get("columns");
        $search = [];
        if(count($param) > 0){
           foreach($param as $item){
                $key = $item['data'];
                $value = $item['search']['value'];
                if(!empty($value) && $key != 'category_name'){
                   array_push($search, [$key, 'like' , '%'.$value.'%']);
                }
            }
        }

        $req_category = $request->input('columns.3.search.value');
        $col = ['content_img','content_index','content_name','category_id','content_persen','content_index','content_id'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $content = Ct_Content::with('category')->select($col)->where($search)
                    ->when($req_category != '', function($query) use($req_category){
                        $query->whereHas('category', function($ct) use($req_category){
                            $ct->where('category_name', 'like' , '%'.$req_category.'%');
                        });
                    })
                    ->orderBy($sort['col'], $sort['dir']);
        $total = $content->count('content_id');
        $data = $content->skip($start)->limit($limit)->get();

        if(!empty($data)) {
            foreach ($data as $keys => $dt) {
                $content_img_link = URL::to('storage/images/content/'.$dt->content_img);
                $dt['content_img'] = '<img src="'.$content_img_link.'" width="90px" />';
                $dt['content_name'] = $dt->content_name;
                $dt['category_name'] = $dt->category->category_name;
                $dt['content_persen'] = $dt->content_persen;
                $dt['content_index'] = $dt->content_index;
                $dt['action'] = '
                    <button type="button" class="btn btn-primary btn-sm btn_edit" data-toggle="modal" data-target="#exampleModal" data-category_id="'.$dt->category_id.'" data-img_link="'.$content_img_link.'">Edit</button>&nbsp;
                    <button type="button" class="btn btn-danger btn-sm btn_delete" data-id="'.$dt->content_id.'">Delete</button>
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
            'content_img' => 'required',
            'content_name' => 'required',
            'category_id' => 'required',
            'content_persen' => 'required',
            'content_index' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $file = $request->file('content_img');
        $cover = null;
        if ($file) {
            $extension = $file->extension();
            $cover = "CO_".time().".".$extension;
            $path = storage_path().'/app/public/images/content/';
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file->move($path, $cover);
            $post['content_img'] = $cover;
        }

        $post['content_index'] = 0;
        $post['content_created'] = date('Y-m-d H:i:s');
        $store = Ct_Content::create($post);
    }

    public function sortlist(Request $request)
    {
        $id = $request->get('id');
        $sorting = $request->get('sorting');

        foreach ($sorting as $item) {
            return Ct_Content::where('content_id', $id)->update(array('content_index' => $sorting));
        }
        
        return response('Update sorting successfully.', 200);
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $data = Ct_Content::where('content_id', $post['id'])->first();

        if ($data != true) {
            return response()->json(['message' => 'ID content not found.'], 404);
        }

        $post = $request->all();
        $validator = Validator::make($post, [
            'content_img' => 'required',
            'content_name' => 'required',
            'category_id' => 'required',
            'content_persen' => 'required',
            'content_index' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $file = $request->file('content_img');
        if ($file) {
            Storage::disk('category')->delete($data->content_img);
            $extension = $file->extension();
            $cover = "CO_".time().".".$extension;
            $path = storage_path().'/app/public/images/content/';
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file->move($path, $cover);
            $post['content_img'] = $cover;
        } else {
            $cover = $data->content_img;
            $post['content_img'] = $cover;
        }

        $post['content_created'] = date('Y-m-d H:i:s');
        $data->update($post);
    }

    public function destroy($content_id)
    {
        $data = Ct_Content::where('content_id', $content_id)->first();

        if ($data == true) {
            if ($data->content_img != null) {
                $del_cover = $data->content_img;
                Storage::disk('content')->delete($del_cover);
            }

            $data->delete();

            return response()->json(['success' => 1, 'message' => 'Delete content succesfully.', 'data' => $data], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'Failed to delete content.', 'data' => []], 404);
        }
    }
}
