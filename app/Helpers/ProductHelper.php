<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductHelper
{

  public static function product($products)
  {
    $perPage = 5;
    $currentPage = request()->input('page', 1);
    $startStt = ($currentPage - 1) * $perPage + 1;
    $html = '';
    foreach ($products as $key => $product) {
      $product->price_sale = $product->price - $product->price * $product->promotion->sale;
      $product->price_sale_formatted = number_format($product->price_sale, 0, '.', '.');
      $product->price_formatted = number_format($product->price, 0, '.', '.');
      $html .= '
        <tr>
          <td>' . $startStt + $key . '</td>
          <td>' . $product->name . '</td>
          <td>' . $product->producttype->name . '</td>
          <td>' . $product->trademark->name . '</td>
          <td>' . $product->quantity . '</td>
          <td><img src="' . $product->thumb . '" width=80px alt="' . $product->name . '"></td>
          <td>' . $product->price_formatted . '</td>
          <td>' . $product->price_sale_formatted . '</td>
          <td>' .
        date('d/m/Y H:i:s', strtotime($product->updated_at)) . '</td>
          <td>
            <a href="/admin/products/edit/id=' . $product->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $product->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $product->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa sản phẩm <b>' . $product->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $product->id . ',\'/admin/products/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($products[$key]);
    }

    return $html;
  }

  public static function products($products): string
  {
    $html = '';
    foreach ($products as $key => $product) {
      $created_at = Carbon::parse($product->created_at);
      $days_diff = $created_at->diffInDays(now());

      $new_label = '';
      if ($days_diff <= 3) {
        $new_label = '<div class="me-2 new">Mới</div>';
      }

      $product->price_sale = $product->price - $product->price * $product->promotion->sale;
      $product->price_sale_formatted = number_format($product->price_sale, 0, '.', '.');
      $product->price_formatted = number_format($product->price, 0, '.', '.');
      $html .= '
            <a href="/product/id='. $product->id .'" class="product-card" data-aos="fade-up">
                <div class="product-card-sale">
                    ' . $new_label . '
                    ' . ($product->promotion->sale != 0 ? '<div class="sale">' . $product->promotion->name . '</div>' : '') . '
                </div>
                <div class="product-card-img">
                    <img src="' . $product->thumb . '"alt="' . $product->name . '">
                </div>
                <div class="product-card-content mt-2">
                    <div>
                        <div class="trademark"><b>' . $product->trademark->name . '</b></div>
                        <div class="name">' . $product->name . '</div>
                    </div>
                    <div class="price mt-2">
                        ' . ($product->promotion->sale != 0 ? '<h6><del>' . $product->price_formatted . ' ₫</del></h6>' : '') . '
                        <h5>' . $product->price_sale_formatted . ' ₫</h5>
                    </div>
                </div>
            </a>
        ';

      unset($products[$key]);
    }

    return $html;
  }
}
