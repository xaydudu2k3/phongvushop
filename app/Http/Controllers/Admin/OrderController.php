<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\HTTP\Services\OrderService;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $statuses = Status::all();
        $orders = Order::with('status', 'customer', 'user')
            ->where('status_id', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);
        $orders->appends(['search' => $search]);
        return view('admin.order.list', [
            'title' => 'Danh Sách đơn hàng',
            'orders' => $orders,
            'statuses' => $statuses,
        ]);
    }

    public function show($id)
    {
        $statuses = Status::all();
        $users = User::where('usertype_id', 4)->get();
        $order = Order::with([
            //   'customer' => function ($query) {
            //     $query->with(['province', 'city']);
            //   },
            'user',
            'status',
            'sale',
            'orderdetails.product'
        ])->findOrFail($id);
        return view('admin.order.edit', [
            'title' => 'Chi tiết đơn hàng: ' . $order->id,
            'order' => $order,
            'statuses' => $statuses,
            'users' => $users
        ]);
    }


    public function update(Order $order, OrderRequest $request)
    {
        $this->orderService->update($request, $order);
        return redirect('/admin/orders/list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->orderService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công đơn hàng'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
