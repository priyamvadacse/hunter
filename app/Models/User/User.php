<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
    'password',
    'interested_age',
    'distance',
    'latitude',
    'f_token'

  ];

  public function scopeDistance(Builder $query, $latitude = NULL, $longitude = NULL, $distance = NULL)
  { 
    return $latitude;exit;
    // $db = db_connect();
    // $q ="SELECT ubar_bd_categories_users_vehicles., ubar_bd_users.status as groupstatus, (((acos(sin(('".$lat."'*3.14/180))  sin((`ubar_bd_users`.`lat`*3.14/180))+cos(('".$lat."'*3.14/180))  cos((`ubar_bd_users`.`lat`*3.14/180))  cos((('".$long."'-`ubar_bd_users`.`long`)*3.14/180))))*180/3.14)*60*1.1515*1.609344) as distance5 , ubar_bd_users.firstname , ubar_bd_users.lastname, ubar_bd_users.email, ubar_bd_users.username , ubar_bd_users.phone, ubar_bd_users.profile_pic, ubar_bd_users.speed, ubar_bd_users.heading	, ubar_bd_users.lat, ubar_bd_users.long , ubar_bd_users.status as userstatus,ubar_bd_users.active 
		// FROM `ubar_bd_categories_users_vehicles` INNER JOIN ubar_bd_users on ubar_bd_users.id = ubar_bd_categories_users_vehicles.user_id INNER JOIN ubar_bd_auth_groups_users on ubar_bd_auth_groups_users.user_id = ubar_bd_users.id WHERE ubar_bd_auth_groups_users.group_id = '6' AND ubar_bd_categories_users_vehicles.status = 'available' AND ubar_bd_users.is_online = 'online' HAVING (distance5 <= 5)";

		// $query = $db->query($q);
    
    // return $query;
    return $query->select('*')
      ->selectRaw('( 6371 * acos( cos( radians(?) ) *
              cos( radians( latitude ) )
              * cos( radians( longitude ) - radians(?)
              ) + sin( radians(?) ) *
              sin( radians( latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude])
      ->havingRaw('distance <= ?', [$distance])
      ->orderBy('distance', 'asc');
  }
}
