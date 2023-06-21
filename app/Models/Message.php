<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected function sendDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value)->toDateTimeLocalString(),
        );
    }

    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
    use HasFactory;
}
