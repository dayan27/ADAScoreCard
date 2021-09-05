<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentPlan extends Model
{
    use HasFactory;
           /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity',
        'quantity_weight',
        'quality_weight',
        'time_weight',
        'to',
        'from',
        'budget',
        'goal',
        'yearly_plan_id',
        'department_id',
         'department_card_id',
        'perspective_id'


    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function department_card(){

        return $this->belongsTo(DepartmentCard::class);
    }

    public function term_activity(){

        return $this->hasOne(TermActivity::class);
    }

    public function user_activities(){

        return $this->hasMany(UserActivity::class);
    }

    public function terms(){

        return $this->hasMany(Term::class);
    }

    public function perspective(){

        return $this->belongsTo(Perspective::class);
    }
     public function yearly_plan(){

        return $this->belongsTo(YearlyPlan::class);
    }
}
