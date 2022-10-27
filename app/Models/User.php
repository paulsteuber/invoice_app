<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function customers(){
        return $this->hasMany(Customer::class)->orderBy('name');
    }
    public function invoices(){
        return $this->hasMany(Invoice::class)->orderBy('invoice_date', 'DESC')->orderBy('invoice_number', 'DESC');
    }
    public function invoice($id){
        return $this->hasMany(Invoice::class)->find($id);
    }
    public function invoice_numbers(){
        $numbers = $this->hasMany(Invoice::class)->get("invoice_number")->pluck("invoice_number")->toArray();
        return implode(",",$numbers);
    }
}
