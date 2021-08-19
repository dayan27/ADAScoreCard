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
        'year',
        'to',
        'from',
        'budget',
        'goal',




       

    ];
}
