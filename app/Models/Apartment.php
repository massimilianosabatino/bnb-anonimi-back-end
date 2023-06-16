<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    //protected $fillable = ['*'];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function sponsorships(){
        return $this->belongsToMany(Sponsorship::class)->withTimestamps();
    }
}
