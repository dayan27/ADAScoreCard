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
        'from',
        'to',
        'score_card_id',
        'department_id'
    ];

    protected $hidden=[
        'created_at',
        'updated_at',

    ];
    public function department_plans(){
        return $this->hasMany(DepartmentPlan::class);
    }
     public function terms(){
        return $this->hasMany(Term::class);
    }

    public function score_cards(){
        return $this->belongsTo(ScoreCard::class);

     }
     public function department(){
         return $this->belongsTo(Department::class);
     }
}
