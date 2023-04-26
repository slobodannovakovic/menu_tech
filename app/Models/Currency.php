<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'label', 'description'];

    public $timestamps = false;

    protected $with = ['surcharge'];

    public function surcharge(): HasOne
    {
        return $this->hasOne(Surcharge::class);
    }
}
