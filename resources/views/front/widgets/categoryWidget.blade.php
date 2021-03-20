@isset($categories)

<div class="col-md-4">
	<div class="card">
		<div class="card-header">
			Kategoriler
			
		</div>
		<div class="list-group">
			@foreach($categories as $category)
			<a href="#" class="list-group-item list-group-item-action">{{$category->name}} <span class="badge badge-primary float-right">{{$category->articleCount()}}</span></a>
			@endforeach

		</div>
		

	</div>

</div>
@endif