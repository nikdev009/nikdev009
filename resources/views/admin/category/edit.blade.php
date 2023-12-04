@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category</li>
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
        <form action="{{route('category.update',[$category->id])}}" method="POST" enctype="multipart/form-data">@csrf
        {{method_field('PUT')}}
              <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                </div>
                <div class="card-body">
                    <div class="form-group"> 
                    <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control " id="" aria-describedby=""
                        value="{{$category->name}}">
                    
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" class="form-control ">{{$category->description}}</textarea>
                      
                    </div>
                    <div class="form-group">
                      <div class="custom-file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                        <input type="file" class="custom-file-input " id="customFile" name="image"><br>
                      
                      </div>
                      <img src="{{Storage::url($category->image)}}" width="150">
                       
                    </div>
                   <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                   </div>
                </div>
              </div>
            </form>

          </div>
</div>
@endsection