<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'id_number',
        'phone',
        'address',
        'notes',
    ];
	
	public function interactions()
	{
		return $this->hasMany(Interaction::class);
	}
}


