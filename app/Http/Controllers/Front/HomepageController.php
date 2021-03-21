<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use Validator;
// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

class HomepageController extends Controller
{

	//her fonksiyonda menüler ('pages') ve kategoriler eklemek yerine bunu construct yaptık
	public function __construct() {
		view()->share('pages', Page::OrderBy('order', 'asc')->get());
		view()->share('categories',Category::OrderBy('name','asc')->get());
	}
	public function index(){

		$data['articles']=Article::OrderBy('title','asc')->simplePaginate(2);
		$data['articles']->withPath('/sayfa');
		//$data['categories']=Category::OrderBy('name','asc')->get();
		//$data['pages']=Page::OrderBy('order', 'asc')->get();
    	//dd(Article::with('getCategory')->find(1));

		return view('front.Homepage',$data);

	}

	public function post($category,$slug){
    	//kategori var mı
		$category=Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
    	//article var mı
		$data['articles']=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı');
		//$data['categories']=Category::OrderBy('name','asc')->get();
		//$data['pages']=Page::OrderBy('order', 'asc')->get();
		return view('front.post', $data);
	}

	public function category($slug){

		$category=Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
		$data['category']=$category;
		$data['articles']=Article::where('category_id', $category->id)->OrderBy('title','asc')->simplePaginate(1);
		//$data['pages']=Page::OrderBy('order', 'asc')->get();
		//$data['categories']=Category::OrderBy('name','asc')->get();
		return view('front.category', $data);
	}

	public function page($slug){
		$page=Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı');
		$data['page']=$page;
		//$data['pages']=Page::OrderBy('order', 'asc')->get();
		return view('front.page', $data);
	}

	public function contact(){
		return view('front.contact');
	}

	public function contactPost(Request $request){


		$validator = Validator::make($request->all(), [
			'name' => 'required|min:5',
			'email' => 'required|email',
			'message'=>'required|min:10',
			'topic'=>'required',
		]);

		if ($validator->fails()) {
			return redirect('iletisim')
			->withErrors($validator)
			->withInput();
		}


		$contact=new Contact;
		$contact->name=$request->name;
		$contact->email=$request->email;
		$contact->message=$request->message;
		$contact->topic=$request->topic;
		$contact->save();
		return redirect()->route('contact')->with('success','Mesajınız İletildi!');
	}
}
