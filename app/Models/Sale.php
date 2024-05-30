<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'token',
    'sale',
    'quantity',
    'active',
  ];
  public function orders()
  {
    return $this->hasMany(Order::class);
  }
}