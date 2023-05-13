<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Image;
use File;

use App\Models\St_Link;

class LinkController extends Controller
{
    public function index()
    {
        $data = St_Link::latest('id')->first();
        return view('admin.setting.link.index', compact('data'));
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $validator = Validator::make($post, [
            'link_btn_login' => 'required',
            'link_btn_register' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $data = St_Link::latest('id')->first();

        if ($data != null) {
            $post['link_updated'] = date('Y-m-d H:i:s');
            $data->update($post);
        } else {
            $post['link_created'] = date('Y-m-d H:i:s');
            St_Link::create($post);
        }
    }
}
