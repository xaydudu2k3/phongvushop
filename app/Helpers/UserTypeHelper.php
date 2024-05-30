<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UserTypeHelper
{
  public static function user_type($user_types)
  {
    $html = '';
    foreach ($user_types as $key => $user_type) {
      $html .= '
        <tr>
          <td>' . $user_type->id . '</td>
          <td>' . $user_type->name . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($user_type->updated_at)) . '</td>
          <td>
            <a href="/admin/user_types/edit/id=' . $user_type->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $user_type->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $user_type->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa loại nhân viên</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa loại nhân viên <b>' . $user_type->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $user_type->id . ',\'/admin/user_types/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($user_types[$key]);
    }

    return $html;
  }
}
