<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyPlan extends Model
{
    use HasFactory;
         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action',
        'budget',
        'to',
        'from',
        'phase',
        'year',
        'year_card_id',
        'make_visible',
        'strategic_plan_id',
 ];
    public function strategic_plan(){

        return $this->belongsTo(StrategicPlan::class);
    }
    public function year_card(){

        return $this->belongsTo(YearCard::class);
    }
}
