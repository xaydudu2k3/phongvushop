<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class PromotionHelper
{
  public static function promotion($promotions)
  {
    // Định nghĩa số sản phẩm trên mỗi trang
    $perPage = 5;
    // Lấy trang hiện tại từ request (mặc định là trang 1)
    $currentPage = request()->input('page', 1);
    // Tính toán giá trị bắt đầu của số thứ tự (startStt)
    $startStt = ($currentPage - 1) * $perPage + 1;
    $html = '';
    foreach ($promotions as $key => $promotion) {
      $stt = $startStt + $key;
      $html .= '
        <tr>
          <td>' . $stt . '</td>
          <td>' . $promotion->name . '</td>
          <td>' . $promotion->sale . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($promotion->updated_at)) . '</td>
          <td>
            <a href="/admin/promotions/edit/id=' . $promotion->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $promotion->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $promotion->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa khuyến mãi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa khuyến mãi <b>' . $promotion->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $promotion->id . ',\'/admin/promotions/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($promotions[$key]);
    }

    return $html;
  }
}
