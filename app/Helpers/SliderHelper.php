<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SliderHelper
{
  public static function slider($sliders)
  {
    $html = '';
    foreach ($sliders as $key => $slider) {
      $html .= '
        <tr>
          <td>' . $slider->id . '</td>
          <td>' . $slider->name . '</td>
          <td>'. $slider->description. '</td>
          <td>' . $slider->url . '</td>
          <td><img src="' . $slider->thumb . '" width=80px alt="' . $slider->name . '"></td>
          <td>' . self::active($slider->active) . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($slider->updated_at)) . '</td>
          <td>
            <a href="/admin/sliders/edit/id=' . $slider->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $slider->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $slider->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa slider</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa slider <b>' . $slider->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $slider->id . ',\'/admin/sliders/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

      unset($sliders[$key]);
    }

    return $html;
  }

  public static function active($active = 0)
  {
    return $active == 0 ? '<span class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></span>' : '<span class="btn btn-success btn-sm"><i class="fa-regular fa-check"></i></span>';
  }

}
