<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\HTTP\Services\PromotionService;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
  protected $promotionService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(PromotionService $promotionService)
  {
    $this->promotionService = $promotionService;
  }
  public function index()
  {
    return view('admin.promotion.list',[
      'title' => 'Danh Sách khuyến mãi',
      'promotions' => $this->promotionService->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.promotion.add',[
      'title' => 'Thêm khuyến mãi mới',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PromotionRequest $request)
  {
    $this->promotionService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Promotion $promotion)
  {
    return view('admin.promotion.edit',[
      'title' => 'Chỉnh Sửa khuyến mãi: ' . $promotion->name ,
      'promotion' => $promotion,
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
  public function update(Promotion $promotion,PromotionRequest $request)
  {
    $this->promotionService->update($request, $promotion);

    return redirect('/admin/promotions/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request):JsonResponse
  {
    $result = $this->promotionService->destroy($request);
    if($result){
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công khuyến mãi'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
