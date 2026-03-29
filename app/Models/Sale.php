<?php

namespace App\Models;

use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
