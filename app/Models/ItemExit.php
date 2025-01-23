<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemExit extends Model
{
    /** @use HasFactory<\Database\Factories\ItemExitFactory> */
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
