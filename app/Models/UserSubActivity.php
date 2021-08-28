<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubActivity extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_sub_activity_id',
        'user_id',
        'user_activity_id'


    ];

    public function term_sub_activity(){

        return $this->belongsTo(TermSubActivity::class);
    }
}
