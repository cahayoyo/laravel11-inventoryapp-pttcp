<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEntry extends Model
{
    /** @use HasFactory<\Database\Factories\ItemEntryFactory> */
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
