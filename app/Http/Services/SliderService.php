<?php

namespace App\HTTP\Services;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SliderService{
  public function get(){
    return Slider::orderbyDesc('id')->paginate(5);
  }

  public function create($request)
  {
    try {
      Slider::create([
        'name' => (string) $request->input('name'),
        'url' => (string) $request->input('url'),
        'thumb' => (string) $request->input('thumb'),
        'description' => (string) $request->input('description'),
        'active' => (string) $request->input('active'),
      ]);

      Session::flash('success', 'Tạo slider thành công');

    } catch (\Exception $err) {
      Session::flash('error', $err->getMessage());
      return false;
    }

    return true;
  }

  public function update($request, $slider) : bool{
    $slider->name = (string) $request->input('name');
    $slider->url = (string) $request->input('url');
    $slider->thumb = (string) $request->input('thumb');
    $slider->description = (string) $request->input('description');
    $slider->active = (string) $request->input('active');
    $slider->save();

    Session::flash('success', 'Cập nhật slider thành công');
    return true;
  }

  public function destroy($request){
    $id = (int) $request->input('id');
    $slider = Slider::where('id', $id)->first();
    if($slider){
      return Slider::where('id', $id)->delete();
    }

    return false;
  }
}