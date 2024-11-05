<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
	
    protected $fillable = [
        'customer_id',
        'date_time',
        'interaction_type',
        'notes',
    ];
	protected $casts = [
		'date_time' => 'datetime',
	];
    // Define the relationship with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
