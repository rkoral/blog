@isset($categories)

<div class="col-md-4">
	<div class="card">
		<div class="card-header">
			Kategoriler
			
		</div>
		<div class="list-group">
			@foreach($categories as $category)
			
				<a href="{{route('category', $category->slug)}}" class="list-group-item list-group-item-action @if(Request::segment(2)==$category->slug) active @endif">{{$category->name}} 
					<span class="badge badge-primary float-right">{{$category->articleCount()}}</span>
				</a>


			
			@endforeach

		</div>


	</div>

</div>
@endif