@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
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
        <form action="{{route('subcategory.store')}}" method="POST" >@csrf
              <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create SubCategory</h6>
                </div>
                <div class="card-body">
                    <div class="form-group"> 
                    <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control " id="" aria-describedby=""
                        placeholder="Enter name of Subcategory">
                    
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
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

          </div>
</div>
@endsection