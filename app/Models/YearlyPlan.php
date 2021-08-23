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
 ];
    public function strategicPlan(){

        return $this->belongsTo(StrategicPlan::class);
    }
}
