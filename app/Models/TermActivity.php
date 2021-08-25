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

        'to',
        'from',
        'term_id',
        'department_plan_id'

    ];
}
