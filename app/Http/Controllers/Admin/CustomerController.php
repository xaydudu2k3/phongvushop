<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\HTTP\Services\CustomerService;
use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends Controller
{
  protected $customerService;

  public function __construct(CustomerService $customerService)
  {
    $this->customerService = $customerService;
  }
  public function index(Request $request)
  {
    $search = $request->get('search');
    $customers = Customer::where('name', 'like', '%' . $search . '%')
      ->orWhere('phone', 'like', '%' . $search . '%')
      ->orWhere('address', 'like', '%' . $search . '%')
      ->orWhere('email', 'like', '%' . $search . '%')
      ->orderBy('id', 'desc')
      ->paginate(5);
    $customers->appends(['search' => $search]);
    return view('admin.customer.list', [
      'title' => 'Danh Sách khách hàng',
      'customers' => $customers
    ]);
  }
  public function search(Request $request)
  {
    $search = $request->get('query');
    $customers = Customer::where('name', 'like', '%' . $search . '%')
      ->orWhere('phone', 'like', '%' . $search . '%')
      ->orWhere('address', 'like', '%' . $search . '%')
      ->orWhere('email', 'like', '%' . $search . '%')
      ->orderBy('id', 'desc')
      ->get()
      ->pluck('name');

    return response()->json($customers);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.customer.add', [
      'title' => 'Thêm khách hàng mới',
    ]);
  }

  public function store(CustomerRequest $request)
  {
    $this->customerService->create($request);
    return redirect()->back();
  }

  public function show(Customer $customer)
  {
    $orders = Order::with(['customer', 'user', 'status', 'orderdetails.product'])
      ->where('customer_id', $customer->id)->orderBy('id','desc')->get();
    return view('admin.customer.edit', [
      'title' => 'Chỉnh sửa khách hàng ' . $customer->name,
      'customer' => $customer,
      'orders' => $orders
    ]);
  }

  public function update(Customer $customer, CustomerRequest $request)
  {
    $this->customerService->update($request, $customer);
    return redirect('/admin/customers/list');
  }

  public function destroy(Request $request): JsonResponse
  {
    $result = $this->customerService->destroy($request);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công khách hàng'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
