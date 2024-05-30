<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\HTTP\Services\UserService;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
  protected $userService;
  /**
   * Display a listing of the resource.
   */
  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function index(Request $request)
  {
    $search = $request->get('search');
    $users = User::select('users.*')->with('usertype')
      ->where('name', 'like', '%' . $search . '%')
      ->orWhere('gender', $search == 'Nam' ? 1 : ($search == 'Nữ' ? 0 : null))
      ->orWhere('cccd', 'like', '%' . $search . '%')
      ->orWhere('phone', 'like', '%' . $search . '%')
      ->orWhere('email', 'like', '%' . $search . '%')
      ->orWhereHas('usertype', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
      ->orderBy('id', 'desc')
      ->paginate(5);
    $users->appends(['search' => $search]);
    return view('admin.user.list', [
      'title' => 'Danh Sách nhân viên',
      'users' => $users
    ]);
  }

  public function search(Request $request)
  {
    $search = $request->get('query');
    $users = User::with('usertype')
      ->where('name', 'like', '%' . $search . '%')
      ->orWhere('gender', $search == 'Nam' ? 1 : ($search == 'Nữ' ? 0 : null))
      ->orWhere('cccd', 'like', '%' . $search . '%')
      ->orWhere('phone', 'like', '%' . $search . '%')
      ->orWhere('email', 'like', '%' . $search . '%')
      ->orWhereHas('usertype', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
      ->orderBy('id', 'desc')
      ->get();
      // ->pluck();

    return response()->json($users);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $usertypes = UserType::all();
    return view('admin.user.add', [
      'title' => 'Thêm nhân viên mới',
      'usertypes' => $usertypes,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userService->create($request);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    $usertypes = UserType::all();
    return view('admin.user.edit', [
      'title' => 'Chỉnh Sửa nhân viên: ' . $user->name,
      'user' => $user,
      'usertypes' => $usertypes,
    ]);
  }

  public function showInfoAdmin()
  {
    $user = Auth::user();
    $userTypes = UserType::all();
    $isAdmin = ($user->usertype_id === 1);
    return view('admin.info.detail', [
      'title' => 'Thông tin người dùng đăng nhập',
    ], compact('user', 'userTypes', 'isAdmin'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(User $user, UserRequest $request)
  {
    if (Auth::user()->usertype_id !== 1) {
      return redirect()->route('admin');
    }

    $this->userService->update($request, $user);

    return redirect('/admin/users/list');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request): JsonResponse
  {
    $result = $this->userService->destroy($request);
    if ($result) {
      return response()->json([
        'error' => false,
        'message' => 'Xóa thành công nhân viên'
      ]);
    }

    return response()->json([
      'error' => true
    ]);
  }
}
