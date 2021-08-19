<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'phone_no',
        'manager_id',
        'yearly_plan_id',
        'department_id'

    ];
    public function strategicplans(){
        return $this->belongsToMany(StrategicPlan::class);
    }
}
