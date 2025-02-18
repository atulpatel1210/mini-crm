<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_hi', 'email', 'website', 'logo'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'hi' ? $this->name_hi : $this->name_en;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
