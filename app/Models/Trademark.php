<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'thumb',
    'url'
  ];
  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
