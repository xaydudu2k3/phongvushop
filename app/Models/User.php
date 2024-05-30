<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'usertype_id',
    'cccd',
    'gender',
    'phone',
    'email',
    'thumb',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  protected function fullTextWildcards($term)
  {
    // removing symbols used by MySQL
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $term = str_replace($reservedSymbols, '', $term);

    $words = explode(' ', $term);

    foreach ($words as $key => $word) {
      /*
       * applying + operator (required word) only big words
       * because smaller ones are not indexed by mysql
       */
      if (strlen($word) >= 1) {
        $words[$key] = '+' . $word . '*';
      }
    }

    $searchTerm = implode(' ', $words);

    return $searchTerm;
  }

  public function scopeFullTextSearch($query, $columns, $term)
  {
    $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

    return $query;
  }
  /**
   * Get users with posts.
   *
   * @return \Illuminate\Support\Collection
   */
  /**
   * Get the user type that owns the user.
   */
  public function usertype()
  {
    return $this->belongsTo(UserType::class);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  //   public function messages()
//   {
//     return $this->hasMany(Message::class);
//   }
}
