<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;
      /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'result',
       'time_result',
       'quality_result',
       'quantity_result',
       'user_id',
       'term_id',

   ];
   public function user_sub_activities(){
    return $this->hasMany(UserSubActivity::class);
}

}
