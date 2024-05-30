<?php

namespace App\HTTP\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{
  public function store($request)
  {
    if ($request->hasFile('file') && strpos($request->file('file')->getMimeType(), 'image') !== false) {
      try {
        $name = $request->file('file')->getClientOriginalName();
        $pathFull = 'uploads/' . date("Y/m/d");

        $request->file('file')->storeAs(
          'public/' . $pathFull,
          $name
        );

        return '/storage/' . $pathFull . '/' . $name;
      } catch (\Exception $error) {
        if ($request->hasFile('file')) {
          Storage::delete('public/' . $pathFull .
          $name);
        }
        return false;
      }
    }
  }
}
