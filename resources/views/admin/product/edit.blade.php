@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Update Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Update Product</li>
            </ol>
    </div>
    <div class="container" >
    @if(Session::has('message'))
                <div class="alert alert-success">
                        {{Session::get('message')}}
                </div>
            @endif
    </div>
    <div class="row justify-content-center">

      <div class="col-lg-10">
        <form action="{{route('product.update',[$product->id])}}" method="POST" enctype="multipart/form-data">@csrf{{method_field('PUT')}}
              <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update product</h6>
                </div>
                <div class="card-body">
                    <div class="form-group"> 
                    <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control " id="" aria-describedby=""
                        value="{{$product->name}}">
                    
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" id="summernote" class="form-control ">{{$product->description}}</textarea>
                      
                    </div>
                    <div class="form-group">
                      <label for="">Image</label>
                      <div class="custom-file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                        <input type="file" class="custom-file-input " id="customFile" name="image">
                      </div>
                      <img src="{{Storage::url($product->image)}}" width="150">
                    </div>
                    <div class="form-group"> 
                      <!-- Validation Errors -->
                          <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control " id="" aria-describedby=""
                          value="{{$product->price}}">
                      
                      </div>
                      <div class="form-group">
                        <label for="">Additonal information</label>
                        <textarea name="addtional_info" id="summernote2" class="form-control ">{{$product->addtional_info}}</textarea>
                        
                      </div>
                      <div class="form-group">
                        <div class="custom-file">
                        <label >Choose Category</label>
                          <select name="category" class="form-control" >
                              <option value="">Select Category</option>
                              @foreach(App\models\category::all() as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                        </div>
                         
                      </div>
                      <div class="form-group">
                        <div class="custom-file">
                        <label >Choose SubCategory</label>
                          <select name="subcategory" class="form-control" >
                              <option value="">Select SubCategory</option>
                             
                              
                          
                          </select>
                        </div>
                         
                      </div>
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

          </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var catId = $(this).val();
            if(catId) {
                $.ajax({
                    url: '/subcategories/'+catId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="subcategory"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }//success close
                });
            }else{ //if close and starts
                $('select[name="subcategory"]').empty();
            }
        });
    });
</script>
@endsection