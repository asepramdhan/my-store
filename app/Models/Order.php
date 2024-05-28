<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // relasi ke payment
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // relasi ke shipment
    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
