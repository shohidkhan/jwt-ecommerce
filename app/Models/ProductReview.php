<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model {
    use HasFactory;
    protected $guarded = [];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function customer() {
        return $this->belongsTo(CustomerProfile::class);
    }
}
