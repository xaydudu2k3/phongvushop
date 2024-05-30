<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Str;

class UserHelper
{

  public static function user($users)
  {
    $html = '';
    foreach ($users as $key => $user) {
      $gender = ($user->gender == 1) ? 'Nam' : 'Nữ';
      $html .= '
        <tr>
          <td>' . $user->id . '</td>
          <td>' . $user->name . '</td>
          <td>' . $user->usertype->name . '</td>
          <td>' . $gender . '</td>
          <td>' . $user->cccd . '</td>
          <td>' . $user->phone . '</td>
          <td>' . $user->email . '</td>
          <td><img src="' . $user->thumb . '" width=80px></td>
          <td>' . date('d-m-Y H:i:s', strtotime($user->updated_at)) . '</td>
          <td>
            <a href="/admin/users/edit/id=' . $user->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $user->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $user->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa nhân viên</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa nhân viên <b>' . $user->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $user->id . ',\'/admin/users/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($users[$key]);
    }

    return $html;
  }
}
