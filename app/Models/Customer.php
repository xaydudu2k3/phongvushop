<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $table = 'customers';

  protected $fillable = [
    'name',
    'phone',
    'address',
    'email',
    'password',
    'status',
    'token',
    'remember_token',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
  ];

  
  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  
}
