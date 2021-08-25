<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSubActivity extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'isAccepeted',
         'term_sub_activity_id',
         'employee_id',
         'employee_activity_id'


    ];
}
