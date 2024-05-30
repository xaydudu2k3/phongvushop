<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrademarkRequest;
use App\HTTP\Services\TrademarkService;
use App\Models\Trademark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrademarkController extends Controller
{
    protected $trademarkService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(TrademarkService $trademarkService)
    {
        $this->trademarkService = $trademarkService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $trademarks = Trademark::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(5);
        $trademarks->appends(['search' => $search]);
        return view('admin.trademark.list', [
            'title' => 'Danh Sách thương hiệu',
            'trademarks' => $trademarks
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->get('query');
        $trademarks = Trademark::where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->get()
            ->pluck('name');

        return response()->json($trademarks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.trademark.add', [
            'title' => 'Thêm thương hiệu mới',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrademarkRequest $request)
    {
        $this->trademarkService->create($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Trademark $trademark)
    {
        return view('admin.trademark.edit', [
            'title' => 'Chỉnh Sửa thương hiệu: ' . $trademark->name,
            'trademark' => $trademark,
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
    public function update(Trademark $trademark, TrademarkRequest $request)
    {
        $this->trademarkService->update($request, $trademark);

        return redirect('/admin/trademarks/list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->trademarkService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công thuơng hiệu'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
