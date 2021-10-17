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
        'yearly_plan_id',
        'department_id',
        'user_id',

    ];

    protected $hidden=[
       'pivot',
       'updated_at',
       'created_at'

    ];


    public function strategicplans(){
        return $this->belongsToMany(StrategicPlan::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function user(){
        return $this->hasOne(User::class)->where('role','department head');
    }
    public function department_plans(){
        return $this->hasMany(DepartmentPlan::class);
    }

    public function department_planss(){
        $dc=DepartmentCard::latest()->first();
        return $this->hasMany(DepartmentPlan::class)->where('department_card',$dc->id);
    }
    public function department_cards(){
        return $this->hasMany(DepartmentCard::class);
    }
}
