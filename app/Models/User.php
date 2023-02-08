<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $softDelete = true;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role_id',
        'gender_id',
        'first_name',
        'last_name',
        'display_picture_link',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function gender(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id');
    }
}
