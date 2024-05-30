<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTypeRequest;
use App\HTTP\Services\ProductTypeService;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
  protected $productTypeService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(ProductTypeService $productTypeService)
  {
    $this->productTypeService = $productTypeService;
  }
  public function index(Request $request)
  {
    $search = $request->get('search');
    $producttypes = ProductType::when($search, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%');
    })
      ->orderBy('id')
      ->paginate(5);
    $producttypes->appends(['search' => $search]);
    return view('admin.product_type.list', [
      'title' => 'Danh sách loại sản phẩm',
      'product_types' => $producttypes
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */

  public function search(Request $request)
  {
    $search = $request->get('query');
    $producttypes = ProductType::where('name', 'like', '%' . $search . '%')
      ->orderBy('id')
      ->get()
      ->pluck('name');

    return response()->json($producttypes);
  }
  public function create()
  {
    return view('admin.product_type.add', [
      'title' => 'Thêm loại sản phẩm mới',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductTypeRequest $request)
  {
    $this->productTypeService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(ProductType $productType)
  {
    return view('admin.product_type.edit', [
      'title' => 'Chỉnh sửa loại sản phẩm: ' . $productType->name,
      'product_type' => $productType,
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
  public function update(ProductType $productType, ProductTypeRequest $request)
  {
    $this->productTypeService->update($request, $productType);

    return redirect('/admin/product_types/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request): JsonResponse
  {
    $result = $this->productTypeService->destroy($request);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công loại sản phẩm'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
