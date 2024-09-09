<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id',
        'device_name',
        'device_location',
    ];
    public function scopeAktif($device) {
        return $device->where('is_active', true);
    }
}
