 @extends('front.layouts.master')
 @section('title',$articles->title)
 @section('bg', $articles->image)
 @section('content') 

 <!-- Post Content -->

 <div class="col-md-8 mx-auto">
 	{{$articles->content}}
 </div>

 @include('front.widgets.categoryWidget')


 <hr>


 @endsection