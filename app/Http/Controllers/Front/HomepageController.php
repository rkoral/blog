<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Article;

class HomepageController extends Controller
{
	public function index(){

		$data['articles']=Article::OrderBy('title','asc')->get();
		$data['categories']=Category::OrderBy('name','asc')->get();
    	//dd(Article::with('getCategory')->find(1));

		return view('front.Homepage',$data);

	}

	public function post($category,$slug){
    	//kategori var mı
		$category=Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
    	//article var mı
		$data['articles']=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı');
		$data['categories']=Category::OrderBy('name','asc')->get();
		return view('front.post', $data);
	}

	public function category($slug){

		$category=Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
		$data['category']=$category;
		$data['articles']=Article::where('category_id', $category->id)->OrderBy('title','asc')->get();
		$data['categories']=Category::OrderBy('name','asc')->get();
		return view('front.category', $data);
	}
}
