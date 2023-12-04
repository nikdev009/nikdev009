<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\subcategory;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::get();
        return view('admin.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg',
            'category'=>'required',
            //'subcategory'=>'required',
            'price'=>'required|numeric'
        ]);
        $image = $request->file('image')->store('public/product');
        product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'addtional_info'=>$request->addtional_info,
            'category_id'=>$request->category,
            //'subcategory_id'=>$request->subcategory
        ]);
        notify()->success('product is created');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = product::find($id);
        $image = $product->image;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/product');
             \Storage::delete($product->image);
           
        }
        $product->name= $request->name;
        $product->description= $request->description;
        $product->addtional_info = $request->addtional_info;
        $product->price = $request->price;
        $product->image=$image;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->save();
        notify()->success('product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $filename = $product->image;
        $product->delete();
        \Storage::delete($filename);
        notify()->success('product is deleted');
        return redirect()->route('product.index');
    }
     public function loadsubcategories(Request $request,$id){
        $subcategory = subcategory::where('category_id',$id)->pluck('name','id');
        return response()->json($subcategory);
     }
}
