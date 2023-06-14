<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
    use HasFactory;
}
