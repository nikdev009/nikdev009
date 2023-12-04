<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use App\Models\slider;
use Cartalyst\Stripe\Api\Products;

class FrontProductListController extends Controller
{
    public function index(){
       
        $products = product::latest()->limit(6)->get();
        $randomactivproducts = product::inRandomOrder()->limit(3)->get();
        $randomactivproductIds = [];
        foreach($randomactivproducts as $product){
            array_push($randomactivproductIds,$product->id);
        }
        $randomiteamproducts = product::whereNotIn('id',$randomactivproductIds)->limit(3)->get();
        $sliders = slider::get();


        return view('product',compact('products','randomiteamproducts','randomactivproducts','sliders'));
    }
    public function show($id){
        $product = product::find($id);
        $productfromsamecategory = product::inRandomOrder()
        ->where('category_id',$product->category_id)
        ->where('id','!=',$product->id)
        ->limit(3)->get();
        
        return view('show',compact('product','productfromsamecategory'));
    }
    public function allproduct($name,Request $request){
        $category = category::where('slug',$name)->first();
        $categoryId = $category->id;
        $subcategory = subcategory::where('category_id',$category->id)->get();
        $slug = $name;
       
        if($request->subcategory){
            $product = $this->filterproduct($request);
            $filter = $this->getsubcategoryId($request); 
            return view('category',compact('product','subcategory','slug','categoryId','filter'));
           
        }elseif($request->min||$request->max){
            $product = $this->filterbyprice($request);
            return view('category',compact('product','subcategory','slug','categoryId'));
        }
        else{
        $product = product::where('category_id',$category->id)->get();
        return view('category',compact('product','subcategory','slug','categoryId'));
        }

        
      
    }
    public function filterproduct(Request $request){
        $subId = [];
        $subcategory = subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId,$sub->id);
        }
        $product = product::whereIn('subcategory_id',$subId)->get();
        return $product;
    }

    public function getsubcategoryId(Request $request){
        $subId = [];
        $subcategory = subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId,$sub->id);
        }
        
        return $subId;
    }
    public function filterbyprice(Request $request){
       $categoryId = $request->categoryId;
        $product = product::whereBetween('price',[$request->min,$request->max])->where('category_id',$categoryId)->get();
        return $product;
    }
    public function moreproducts(Request $request){
        if($request->search){
            $products = product::where('name','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('addtional_info','like','%'.$request->search.'%')
            ->paginate(50);
            return view('all-product',compact('products'));
        }
        $products = Product::latest()->paginate(50);
        return view('all-product',compact('products'));
    }
}
