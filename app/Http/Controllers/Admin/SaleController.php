<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\HTTP\Services\SaleService;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
  protected $saleService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(SaleService $saleService)
  {
    $this->saleService = $saleService;
  }
  public function index(Request $request)
  {
    $search = $request->get('search');
    $sales = Sale::where('name', 'like', '%' . $search . '%')
      ->orWhere('token', 'like', '%' . $search . '%')
      ->orderBy('id')
      ->paginate(5);
    $sales->appends(['search' => $search]);
    return view('admin.sale.list', [
      'title' => 'Danh Sách mã giảm giá',
      'sales' => $sales
    ]);
  }
  public function search(Request $request)
  {
    $search = $request->get('query');
    $sales = Sale::where('name', 'like', '%' . $search . '%')
      ->orWhere('token', 'like', '%' . $search . '%')
      ->orderBy('id')
      ->get()
      ->pluck('name');

    return response()->json($sales);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.sale.add', [
      'title' => 'Thêm mã giảm giá mới',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SaleRequest $request)
  {
    $this->saleService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Sale $sale)
  {
    return view('admin.sale.edit', [
      'title' => 'Chỉnh sửa mã giảm giá: ' . $sale->name,
      'sale' => $sale,
    ]);
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Sale $sale, SaleRequest $request)
  {
    $this->saleService->update($request, $sale);

    return redirect('/admin/sales/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request): JsonResponse
  {
    $result = $this->saleService->destroy($request);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công mã giảm giá'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
