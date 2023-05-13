<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Ct_Category;
use App\Models\Ct_Content;
use App\Models\Bn_Banner;
use App\Models\St_Link;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = Ct_Category::orderby('category_id', 'ASC')->get();
        $content = Ct_Content::with('category')->where('category_id', 1)->orderby('content_index', 'ASC')->get();
        $category_title = Ct_Category::where('category_id', 1)->first();

        $data = array(
            "categorys" => $category,
            "contents" => $content,
            "title_category" => $category_title
        );

        return view('web.home.index')->with($data);
    }

    public function byId(Request $request, $name, $id)
    {
        $category = Ct_Category::orderby('category_id', 'ASC')->get();
        $content = Ct_Content::with('category')->where('category_id', $id)->orderby('content_index', 'ASC')->get();
        $category_title = Ct_Category::where('category_id', $id)->first();

        if($category_title != true){
            return abort(404);
        }

        $data = array(
            "categorys" => $category,
            "contents" => $content,
            "title_category" => $category_title
        );

        return view('web.home.index')->with($data);
    }

    public function get_banner(Request $request)
    {
        $category = Bn_Banner::orderby('banner_id', 'DESC')->get();
        return $category;
    }

    public function get_link_btn(Request $request)
    {
        $links = St_Link::latest('id')->first();
        return $links;
    }
}
