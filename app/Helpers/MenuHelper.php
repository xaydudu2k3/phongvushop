<?php

namespace App\Helpers;


class MenuHelper
{
  public static function menu($menus, $parent_id = 0, $char = '')
  {
    $html = '';
    foreach ($menus as $key => $menu) {
      if ($menu->parent_id == $parent_id) {
        $html .= '
        <tr>
          <td>' . $menu->id . '</td>
          <td>' . $char . $menu->name . '</td>
          <td>' . $menu->url . '</td>
          <td>' . self::active($menu->active) . '</td>
          <td>' . date('d-m-Y H:i:s', strtotime($menu->updated_at)) . '</td>
          <td>
            <a href="/admin/menus/edit/id=' . $menu->id . '" class="btn btn-primary btn-sm">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Modal' . $menu->id . '">
              <i class="fa-regular fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Modal' . $menu->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa danh mục</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc xóa danh mục <b>' . $menu->name . '</b> không ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeRow(' . $menu->id . ',\'/admin/menus/destroy\')">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        ';

        unset($menus[$key]);

        $html .= self::menu($menus, $menu->id, $char . '--');
      }
    }

    return $html;
  }


  public static function active($active = 0)
  {
    return $active == 0 ? '<span class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></span>' : '<span class="btn btn-success btn-sm"><i class="fa-regular fa-check"></i></span>';
  }

  public static function menus($menus, $parent_id = 0): string
  {
    $html = '';
    $currentUrl = request()->url();
    foreach ($menus as $key => $menu) {
      $isActive = false; // Biến để kiểm tra xem mục hiện tại có được chọn là "active" hay không

      if ($menu->url === 'product' && strpos($currentUrl, 'product') !== false) {
        $isActive = true; // Nếu URL hiện tại chứa "product", thì đánh dấu mục "product" là "active"
      } elseif ($currentUrl === $menu->url) {
        $isActive = true; // Nếu URL hiện tại trùng khớp với URL của menu item, thì đánh dấu mục đó là "active"
      }
      if ($menu->parent_id == $parent_id) {
        $html .= '
          <li class="nav-item menu-header-item-menu ' . (request()->is($menu->url) || $isActive ? 'active-header' : '') . '">
            <a class="nav-link" href="' . ((!empty($menu->url) && preg_match('/[a-zA-Z]/', $menu->url)) ? '/' : '') . $menu->url . '">
            ' . $menu->name . '
            </a>';
        unset($menus[$key]);
        if (self::isChild($menus, $menu->id)) {
          $html .= '<ul class="menu-drop">';
          $html .= self::menus($menus, $menu->id);
          $html .= '</ul>';
        }
        $html .= '</li>';
      }
    }

    return $html;
  }


  public static function isChild($menus, $id): bool
  {
    foreach ($menus as $menu) {
      if ($menu->parent_id == $id) {
        return true;
      }
    }

    return false;
  }

  public static function menucart($menus, $parent_id = 0)
  {
    $html = '';
    foreach ($menus as $key => $menu) {
      if ($menu->parent_id == $parent_id) {
        $html .= '
        ';
      }
    }

    return $html;
  }
}
