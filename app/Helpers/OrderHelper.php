<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class OrderHelper
{

  public static function order($orders)
  {
    $html = '';
    foreach ($orders as $key => $order) {
      $userSet = ($order->userset_id == NULL) ? '' : ($order->userSet->name . ' (' . $order->userSet->usertype->name . ')');
      $userShip = ($order->user_id == NULL) ? '' : ($order->user->name);
      $statusClass = '';
      switch ($order->status_id) {
        case 1:
          $statusClass = 'wait';
          break;
        case 2:
          $statusClass = 'confirm';
          break;
        case 3:
          $statusClass = 'shipping';
          break;
        case 4:
          $statusClass = 'delivered';
          break;
        case 5:
          $statusClass = 'cancel';
          break;
        default:
          $statusClass = 'null';
          break;
      }
      $html .= '
        <tr>
          <td>' . $order->id . '</td>
          <td>' . $order->customer->name . ' (' . $order->customer->phone . ')</td>
          <td>' . $userSet . ' </td>
          <td>' . $userShip . ' </td>
          <td><div class="main-order-'. $statusClass .'">' . $order->status->name . '</div></td>
          <td>' . date('d-m-Y H:i:s', strtotime($order->updated_at)) . '</td>
          <td>
            <a href="/admin/orders/edit/id=' . $order->id . '" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-eye"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $order->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $order->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa hóa đơn</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa hóa đơn <b>' . $order->id . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $order->id . ',\'/admin/orders/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($orders[$key]);
    }

    return $html;
  }
}
