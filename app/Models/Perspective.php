<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perspective extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',


    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function strategic_plans(){
        return $this->hasMany(StrategicPlan::class);
    }
}
