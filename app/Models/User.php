<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'proffesion',
        'comment',
        'phone_no',
        'email',
        'gender',
        'password',
        'department_id',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function user_activities(){
        return $this->hasMany(UserActivity::class);
    }
    public function behaviors(){
       // return $this->belongsToMany(Behavior::class)->as('values')->withPivot('dapartment_card_id','term_id','result');
       return $this->belongsToMany(Behavior::class)->withPivot('department_card_id','result','result_scale');
    }

    public function terms(){
        // return $this->belongsToMany(Behavior::class)->as('values')->withPivot('dapartment_card_id','term_id','result');
        return $this->belongsToMany(Term::class)->withPivot('user_id','term_id','draft_visiblity');
     }

    public function user_sub_activities(){
        return $this->hasMany(UserSubActivity::class);
    }
}
