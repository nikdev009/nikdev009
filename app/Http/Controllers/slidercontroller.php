<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class slidercontroller extends Controller
{
    public function index(){
        $slider = slider::get();
        return view('admin.slider.index',compact('slider'));
    }
    public function create(){
        return view('admin.slider.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'image' => 'required|mimes:png,jpg'
        ]);
        $image = $request->file('image')->store('public/slider');
        slider::create([
            'image'=>$image,
        ]);
        notify()->success('slider is created successfully!');
        return redirect()->route('slider.index');
    }
    public function destroy($id){
        $slider = slider::find($id)->delete();
        notify()->success('slider is deleted successfully!');
        return redirect()->back();
    }
}
