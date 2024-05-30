<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HTTP\Services\UploadService;
use Illuminate\Http\Request;

/**
 * Summary of UploadController
 */
class UploadController extends Controller
{
  protected $upload;

  /**
   * Summary of __construct
   * @param UploadService $upload
   */
  public function __construct(UploadService $upload)
  {
    $this->upload = $upload;
  }
  public function store(Request $request)
  {
    $url = $this->upload->store($request);
    if ($url !== false) {
      return response()->json([
        'error' => false,
        'url'   => $url
      ]);
    }
    return response()->json(['error' => 'File nhập vào không phải là file ảnh'], 422);
  }
}
