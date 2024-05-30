<?php

namespace App\Helpers;

use App\Models\ProductType;
use App\Models\Promotion;
use Illuminate\Support\Str;

class ProductTypeHelper
{
  public static function product_type($product_types)
  {// Định nghĩa số sản phẩm trên mỗi trang
    $perPage = 5;
    // Lấy trang hiện tại từ request (mặc định là trang 1)
    $currentPage = request()->input('page', 1);
    // Tính toán giá trị bắt đầu của số thứ tự (startStt)
    $startStt = ($currentPage - 1) * $perPage + 1;
    $html = '';
    foreach ($product_types as $key => $product_type) {
      $stt = $key + $startStt;
      $html .= '
        <tr>
          <td>' . $stt . '</td>
          <td>' . $product_type->name . '</td>
          <td><img src="' . $product_type->thumb . '" width=80px alt="' . $product_type->name . '"></td>
          <td>' . self::active($product_type->active) . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($product_type->updated_at)) . '</td>
          <td>
            <a href="/admin/product_types/edit/id=' . $product_type->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $product_type->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $product_type->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa loại sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa loại sản phẩm <b>' . $product_type->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $product_type->id . ',\'/admin/product_types/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($product_types[$key]);
    }

    return $html;
  }
  public static function active($active = 0)
  {
    return $active == 0 ? '<span class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></span>' : '<span class="btn btn-success btn-sm"><i class="fa-regular fa-check"></i></span>';
  }
}
