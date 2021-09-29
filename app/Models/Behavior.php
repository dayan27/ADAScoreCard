<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'maximum_score_point',
        'description',
        'weight',

    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('term_id','department_card_id','result_scale','result');
    }

}

