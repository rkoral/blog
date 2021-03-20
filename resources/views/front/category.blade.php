@extends('front.layouts.master')
@section('title',$category->name)
@section('content')

<!-- Main Content -->



<div class="col-md-8 mx-auto">
	@if(count($articles)>0)
	@foreach($articles as $article)
	<div class="post-preview">
		<a href="{{route('post',[$article->getCategory->slug, $article->slug ])}}">
			<h2 class="post-title">
				{{$article->title}}
			</h2>
			<h3 class="post-subtitle">
				{{Str::limit($article->content, 75)}}
			</h3>
		</a>
		<p class="post-meta">Kategori: 
			<a href="#">{{$article->getCategory->name}}</a>
			<span class="float-right">{{$article->created_at->diffForHumans()}}</span>
		</p>
	</div>
	<hr>

	@endforeach
	@else 
	<div class="alert alert-danger">
		<h2>{{$category->name}} Kategorisine Ait Yazı Bulunamadı!</h2>
	</div>
	@endif
	

	
</div>


@include('front.widgets.categoryWidget')
@endsection