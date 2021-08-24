<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategicPlan extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'action',
        'to',
        'from',
        'perspective',
        'score_card_id',
      
    
    ];
    public function departments(){
        return $this->belongsToMany(Department::class);
    }
    public function yearly_plans(){

        return $this->hasMany(yearlyPlans::class);
    }
    public function score_card(){
        return $this->belongsTo(ScoreCard::class);
    }
}
