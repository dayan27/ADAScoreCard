<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermActivity extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [


        'term_id',
        'department_plan_id'

    ];

    protected $hidden=[
        'created_at',
        'updated_at',
    ];
    public function department_plan(){

        return $this->belongsTo(DepartmentPlan::class);
    }

    public function term(){

        return $this->belongsTo(Term::class);
    }
     public function term_sub_activities(){

        return $this->hasMany(TermSubActivity::class);
    }

    public function user_activities(){

        return $this->hasMany(UserActivity::class);
    }

}
