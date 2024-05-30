<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class CustomerHelper
{

  public static function customer($customers)
  {
    $html = '';
    foreach ($customers as $key => $customer) {
      $html .= '
        <tr>
          <td>' . $customer->id . '</td>
          <td>' . $customer->name . '</td>
          <td>' . $customer->phone . '</td>
          <td>
          ' . $customer->address . ',
          </td>
          <td>' . $customer->email . '</td>
          <td>' . self::active($customer->status) . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($customer->created_at)) . '</td>
          <td>
            <a href="/admin/customers/edit/id=' . $customer->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $customer->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $customer->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa khách hàng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa khách hàng <b>' . $customer->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $customer->id . ',\'/admin/customers/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($customers[$key]);
    }

    return $html;
  }

  public static function active($active = 0)
  {
    return $active == 0 ? '<span class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></span>' : '<span class="btn btn-success btn-sm"><i class="fa-regular fa-check"></i></span>';
  }
}
