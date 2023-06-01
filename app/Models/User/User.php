<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $table = 'users';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name',
    'email',
    'pic1',
    'pic2',
    'pic3',
    'pic4',
    'phone',
    'dob',
    'gender',
    'interested_in',
    'status',
    'password'

  ];

  

}
