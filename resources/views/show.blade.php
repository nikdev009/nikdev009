@extends('admin.layouts.all')

@section('content')


<div class="container">


	
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
			<section class="gallery-wrap"> 
			<div class="img-big-wrap">
			  <div> <a href="#">
               
			  	<img src="{{Storage::url($product->image)}}"></a>
               
			  </div>
			</div> 
			
			</section> 
		</aside>



		<aside class="col-sm-7">
			<section class="card-body p-5">
				<h3 class="title mb-3"></h3>

<p class="price-detail-wrap"> 
	<span class="price h3 text-danger"> 
		<span class="currency">US ${{$product->price}}</span>Price
	</span> 
	 
</p> <!-- price-detail-wrap .// -->
  <h3><b>Description<b></h3>
  <p>{{$product->description}} </p>
  <b><h3>Additional information</h3></b>
  <p>{{$product->addtional_info}} </p>


<br>
<hr>

	<hr>
	<br>
	<a href="{{route('add.cart',[$product->id])}}" class="btn btn-lg btn-outline-primary text-uppercase">  Add to cart </a>
</section> 
		</aside> 

	</div> 

</div> 

@if(count($productfromsamecategory)>0)
<div class="jumbotron">
	<h3> You may like</h3>
	<div class="row">
		@foreach ($productfromsamecategory as $product)
		  <div class="col-4">
			<div class="card mb-4 shadow-sm">
			  <img src="{{Storage::url($product->image)}}" height="200" style="width:100%">
			  <div class="card-body">
				<p><b>{{$product->name}}</b></p>
				<p class="card-text">{{Str::limit($product->description,60)}}</p><br>
				<div class="d-flex justify-content-between align-items-center">
				  <div class="btn-group">
					<a href="{{route('product.view',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-success">View</button></a>
				   
					<a href="{{route('add.cart',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-primary ">Add to cart</button></a>
					</div>
				  <small class="text-muted">${{$product->price}}</small>
				</div>
			  </div>
			</div>
		  </div>
		@endforeach
	  </div>
</div>
@endif

</div>


@endsection