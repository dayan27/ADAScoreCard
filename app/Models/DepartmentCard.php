<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCard extends Model
{
    use HasFactory;


    protected $fillable = [
        'year',
        'number_of_term',
        'make_visible',
    ];

    protected $hidden=[
        'created_at',
        'updated_at',
        'make_visible'
    ];
    public function department_plans(){
        return $this->hasMany(DepartmentPlan::class);
    }
     public function terms(){
        return $this->hasMany(Term::class);
    }
}
