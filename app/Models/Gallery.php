<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function apartament()
    {
        return $this->belongsTo(Apartament::class);
    }
    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value)=>$value?asset('storage/'.$value):null,
        );
    }
}
