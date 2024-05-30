<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\HTTP\Services\Slider\SliderService as SliderSliderService;
use App\HTTP\Services\SliderService;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
  protected $sliderService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(SliderService $sliderService)
  {
    $this->sliderService = $sliderService;
  }
  public function index()
  {
    return view('admin.slider.list',[
      'title' => 'Danh Sách slider',
      'sliders' => $this->sliderService->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.slider.add',[
      'title' => 'Thêm slider mới',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SliderRequest $request)
  {
    $this->sliderService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Slider $slider)
  {
    return view('admin.slider.edit',[
      'title' => 'Chỉnh Sửa slider: ' . $slider->name ,
      'slider' => $slider,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Slider $slider,SliderRequest $request)
  {
    $this->sliderService->update($request, $slider);

    return redirect('/admin/sliders/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request):JsonResponse
  {
    $result = $this->sliderService->destroy($request);
    if($result){
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công slider'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
