 @extends('front.layouts.master')
 @section('title','İletişim')
 @section('bg', 'http://d2vision.com/blog/img/contact-bg.jpg')
 @section('content') 

 <div class="col-md-8">
 	@if(session('success'))
 	<div class="alert alert-success">
 		{{session('success')}}
 	</div>
 	@endif
 	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 	<p>Bizimle İletişime Geçebilirsiniz:</p>

 	<form method="post" action="{{route('contact.post')}}">
 		@csrf
 		<div class="control-group">
 			<div class="form-group  controls">
 				<label>Ad Soyad</label>
 				<input type="text" class="form-control" value="{{old('name')}}" placeholder="Ad Soyadınız" name="name" required>
 				<p class="help-block text-danger"></p>
 			</div>
 		</div>
 		<div class="control-group">
 			<div class="form-group controls">
 				<label>Email Adres</label>
 				<input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Adresiniz" name="email" required >
 				<p class="help-block text-danger"></p>
 			</div>
 		</div>
 		<div class="control-group">
 			<div class="form-group col-xs-12  controls">
 				<label>Konu</label>
 				<select class="form-control" name="topic">
 					<option>Destek</option>
 					<option>Bilgi</option>
 					<option>Genel</option>
 				</select>
 			</div>
 		</div>
 		<div class="control-group">
 			<div class="form-group controls">
 				<label>Mesaj</label>
 				<textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" required >{{old('message')}}</textarea>
 				<p class="help-block text-danger"></p>
 			</div>
 		</div>
 		<br>
 		<div id="success"></div>
 		<button type="submit" class="btn btn-primary" name="sendMessageButton">Gönder</button>
 	</form>
 </div>
 <div class="col-md-4">
 	<div class="card card-default">

 		<div class="card-body">Panel</div>
 		Adres: bla bla (buraya bak!)
 	</div>


 </div>

 @endsection

