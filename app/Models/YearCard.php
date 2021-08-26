<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',


 ];
 protected $hidden=[
    'created_at',
    'updated_at'
];
 public function yearly_plans(){
     return $this->hasMany(YearlyPlan::class);
 }

}
