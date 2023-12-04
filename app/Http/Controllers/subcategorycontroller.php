<?php

namespace App\Http\Controllers;

use App\Models\subcategory;
use Illuminate\Http\Request;


class subcategorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = subcategory::get();
        return view('admin.subcategory.index',compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.create');
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
            'name'=> 'required|min:3',
            'category'=>'required',
        ]);
        subcategory::create([
            'name'=>$request->name,
            'category_id'=>$request->category,
        ]);
        notify()->success('Subcategory is created');
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
        $subcategory = subcategory::find($id);
        return view('admin.subcategory.edit',compact('subcategory'));
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
         $this->validate($request,[
            'name'=>'required|min:3',
            'category'=>'required',
         ]);
            $subcategory = subcategory::find($id);
            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category;
            $subcategory->save();
            notify()->success('Subcategory is update');
            return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = subcategory::find($id);
        $subcategory->delete();
        notify()->success('Subcategory is deleted');
        return redirect()->route('subcategory.index');
    }
}
