<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCard extends Model
{
    use HasFactory;


    protected $fillable = [
        'year',
        'number_of_term',
        'make_visible',
    ];
}
