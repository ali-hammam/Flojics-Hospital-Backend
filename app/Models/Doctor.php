<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'experience',
        'specializtion_id'
    ];

    public function reservations(){
        return $this->hasMany(Reserve::class);
    }

    public function specialization(){
        return $this->belongsTo(Specializtion::class);
    }
}
