<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $guarded = [];

    public function ipabaja()
    {
        return $this->belongsTo(IpaBaja::class, 'ipa_baja_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }
}
