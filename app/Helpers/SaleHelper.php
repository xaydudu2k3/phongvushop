<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SaleHelper
{
  public static function sale($sales)
  {
    // Định nghĩa số sản phẩm trên mỗi trang
    $perPage = 5;
    // Lấy trang hiện tại từ request (mặc định là trang 1)
    $currentPage = request()->input('page', 1);
    // Tính toán giá trị bắt đầu của số thứ tự (startStt)
    $startStt = ($currentPage - 1) * $perPage + 1;
    $html = '';
    foreach ($sales as $key => $sale) {
      $stt = $startStt + $key;
      $html .= '
        <tr>
          <td>' . $stt . '</td>
          <td>' . $sale->name . '</td>
          <td>' . $sale->token . '</td>
          <td>' . $sale->quantity . '</td>
          <td>' . $sale->sale . '</td>
          <td>' . self::active($sale->active) . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($sale->updated_at)) . '</td>
          <td>
            <a href="/admin/sales/edit/id=' . $sale->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $sale->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $sale->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa mã giảm giá</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa mã giảm giá <b>' . $sale->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $sale->id . ',\'/admin/sales/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($sales[$key]);
    }

    return $html;
  }
  public static function active($active = 0)
  {
    return $active == 0 ? '<span class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></span>' : '<span class="btn btn-success btn-sm"><i class="fa-regular fa-check"></i></span>';
  }
}
