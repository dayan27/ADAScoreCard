<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_no',
        'title',
        'year',
        'department_id'


    ];
}
