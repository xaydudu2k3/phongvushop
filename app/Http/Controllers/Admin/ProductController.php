<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\HTTP\Services\ProductService;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Promotion;
use App\Models\Trademark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
  protected $productService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function index(Request $request)
  {
    $trademarks = Trademark::all();
    $producttypes = ProductType::all();
    $search = $request->get('search');
    $productTypeId = $request->get('producttype_id');
    $trademarkId = $request->get('trademark_id');
    $products = Product::with(['producttype', 'trademark', 'promotion'])
      ->when($search, function ($query, $search) {
        $query->where('name', 'like', '%' . $search . '%')
          ->orWhereHas('producttype', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('trademark', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
          });
      })
      ->when($productTypeId, function ($query, $productTypeId) {
        $query->where('producttype_id', $productTypeId);
      })
      ->when($trademarkId, function ($query, $trademarkId) {
        $query->where('trademark_id', $trademarkId);
      })
      ->orderBy('id', 'desc')
      ->paginate(5);

    $products->appends([
      'search' => $search,
      'producttype_id' => $productTypeId,
      'trademark_id' => $trademarkId
    ]);
    return view('admin.product.list', [
      'title' => 'Danh sách sản phẩm',
      'trademarks' => $trademarks,
      'producttypes' => $producttypes,
      'products' => $products,
    ]);
  }

  public function search(Request $request)
  {
    $search = $request->get('query');
    $products = Product::with(['producttype', 'trademark', 'promotion'])
      ->when($search, function ($query, $search) {
        $query->where('name', 'like', '%' . $search . '%')
          ->orWhereHas('producttype', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('trademark', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
          });
      })
      ->orderBy('id', 'desc')
      ->pluck('name');

    return response()->json($products);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $trademarks = Trademark::all();
    $producttypes = ProductType::all();
    $promotions = Promotion::all();
    return view('admin.product.add', [
      'title' => 'Thêm sản phẩm mới',
      'trademarks' => $trademarks,
      'producttypes' => $producttypes,
      'promotions' => $promotions,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductRequest $request)
  {
    $this->productService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    $trademarks = Trademark::all();
    $producttypes = ProductType::all();
    $promotions = Promotion::all();
    return view('admin.product.edit', [
      'title' => 'Chỉnh Sửa sản phẩm: ' . $product->name,
      'product' => $product,
      'producttypes' => $producttypes,
      'trademarks' => $trademarks,
      'promotions' => $promotions,
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
  public function update(Product $product, ProductRequest $request)
  {
    $this->productService->update($request, $product);
    return redirect('/admin/products/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request): JsonResponse
  {
    $result = $this->productService->destroy($request);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công sản phẩm'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
