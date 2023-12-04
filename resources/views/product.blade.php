
@extends('admin.layouts.all')

@section('content')
<div class="container">
<main role="main">

    
      <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($sliders as $key=>$slider)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
              <img src="{{Storage::url($slider->image)}}" >
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    
    <h2>Category</h2>
    @foreach(App\models\category::all() as $category)
  <a href="{{route('produt.list',[$category->slug])}}"><button class="btn btn-secondary">{{$category->name}}</button></a>
    @endforeach
  
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Products</h2>
  
        <div class="row">
         @foreach($products as $product)
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <img src="{{Storage::url($product->image)}}" height="200" style="width:100%">
              <div class="card-body">
                <p><b>{{$product->name}}</b></p>
                <p class="card-text">{!! $product->description !!}</p><br>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{route('product.view',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-success">View</button></a>
                   
                    <a href="{{route('add.cart',[$product->id])}}"> <button type="button" class="btn btn-sm btn-outline-primary ">Add to cart</button></a>
                    </div>
                  <small class="text-muted">${{$product->price}}</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
     <center><a href="{{route('more.product')}}"><button class="btn btn-success">More Product</button></a></center> 
    </div>
  
      <div class="jumbotron">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              
              <div class="row">
                @foreach ($randomactivproducts as $product)
                
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
            <div class="carousel-item ">
              
              <div class="row">
                @foreach ($randomiteamproducts as $product)
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


          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>




  </main>
  
  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p></p>
      <p></p>
    </div>
  </footer>
</div>
  @endsection