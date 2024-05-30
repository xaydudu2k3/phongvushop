<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTypeRequest;
use App\HTTP\Services\UserTypeService;
use App\Models\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
  protected $userTypeService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(UserTypeService $userTypeService)
  {
    $this->userTypeService = $userTypeService;
  }
  public function index()
  {
    return view('admin.user_type.list',[
      'title' => 'Danh Sách loại nhân viên',
      'user_types' => $this->userTypeService->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.user_type.add',[
      'title' => 'Thêm loại nhân viên mới',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserTypeRequest $request)
  {
    $this->userTypeService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(UserType $userType)
  {
    return view('admin.user_type.edit',[
      'title' => 'Chỉnh Sửa loại nhân viên: ' . $userType->name ,
      'user_type' => $userType,
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
  public function update(UserType $userType, UserTypeRequest $request)
  {
    $this->userTypeService->update($request, $userType);

    return redirect('/admin/user_types/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request):JsonResponse
  {
    $result = $this->userTypeService->destroy($request);
    if($result){
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công loại nhân viên'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
