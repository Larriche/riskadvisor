<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(InsuranceProduct::class, 'submission_products', 'submission_id', 'product_id');
    }
}
