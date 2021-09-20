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
        'to',
        'from',
        'department_id',
        'make_visible',
        'department_card_id'


    ];
    protected $hidden=[
        'created_at',
        'updated_at',
    ];
    public function department_card(){
        return $this->belongsTo(DepartmentCard::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('user_id','term_id','draft_visiblity');
    }
}
