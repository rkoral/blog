<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\contactRequest;
use Illuminate\Support\Facades\Validator;
// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

class HomepageController extends Controller
{
	public function __construct() {
		view()->share('pages', Page::OrderBy('order', 'asc')->get());
		view()->share('categories',Category::with('articles')->OrderBy('name','asc')->get());
	}
	public function index(){
		$data['articles']=Article::with('getCategory')->OrderBy('title','asc')->simplePaginate(2)->withPath('/sayfa');
		return view('front.homepage',$data);
	}

	public function post($category,$slug){
		$category=Category::where('slug',$category)->firstOrFail();
		$data['articles']=Article::where('slug', $slug)->where('category_id',$category->id)->firstOrFail();
		return view('front.post', $data);
	}

	public function category($slug){		
		$data['category']=Category::where('slug',$slug)->firstOrFail();
		$data['articles']=Article::where('category_id', $data['category']->id)->OrderBy('title','asc')->simplePaginate(1);
		return view('front.category', $data);
	}

	public function page($slug){
		$data['page']=Page::where('slug', $slug)->firstOrFail();
		return view('front.page', $data);
	}

	public function contact(){
		return view('front.contact');
	}

	public function contactPost(contactRequest $request){
			$contact=new Contact;
			$contact->name=$request->name;
			$contact->email=$request->email;
			$contact->message=$request->message;
			$contact->topic=$request->topic;
			$contact->save();
			return redirect()->route('contact')->with('success','Mesajınız İletildi!');
		}
}






