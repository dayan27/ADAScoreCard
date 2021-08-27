<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermSubActivity extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'level',
        'measurment',
        'added_by',
        'term_activity_id'



    ];

    protected $hidden=[
        'created_at',
        'updated_at',
    ];
    public function term_activities(){

        return $this->belongsTo(TermActivity::class);
    }

    public function department_plan(){

        return $this->belongsTo(TermActivity::class);
    }
}
