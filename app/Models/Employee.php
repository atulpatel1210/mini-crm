<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'first_name_en', 'first_name_hi', 'last_name_en', 'last_name_hi', 'email', 'phone'];

    public function getFirstNameAttribute()
    {
        return app()->getLocale() == 'hi' ? $this->first_name_hi : $this->first_name_en;
    }

    public function getLastNameAttribute()
    {
        return app()->getLocale() == 'hi' ? $this->last_name_hi : $this->last_name_en;
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
