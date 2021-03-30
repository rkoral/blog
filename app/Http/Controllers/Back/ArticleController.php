<?php

namespace App\Http\Controllers\Back;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\articleStoreRequest;
use App\Http\Requests\articleUpdateRequest;

use App\Models\Article;
use App\Models\Category;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['articles']=Article::with('getCategory')->orderBy('created_at', 'DESC')->get();
        return view('back.articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories']=Category::with('articles')->get();
        return view('back.articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(articleStoreRequest $request)
    {
        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title, '-');

        if ($request->hasFile('image')) {
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $article->image = $fileName;           
        }
        $article->save();
        toastr()->success('Makaleniz oluşturuldu!');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::with('articles')->get();
        return view('back.articles.update', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(articleUpdateRequest $request, $id)
    {
     $article=Article::findOrFail($id);
     $article->title=$request->title;
     $article->category_id=$request->category;
     $article->content=$request->content;
     $article->slug=Str::slug($request->title, '-');

     if ($request->hasFile('image')) {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
        $article->image = $fileName;           
    }
    $article->save();
    toastr()->success('Makaleniz güncellendi!');
    return redirect()->route('admin.makaleler.index'); 
}


public function switch(Request $request)
{
 $article = Article::findOrFail($request->id);
 $article->status = $request->statu=="true" ? 1 : 0;
 $article->save();

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
