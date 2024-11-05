<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'status',
        'priority',
        'assigned_to',
    ];

    // Relationship with the customer who created the ticket
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship with the assigned team member
    public function assignedTeamMember()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
	
	public function assignedUser()
	{
		return $this->belongsTo(User::class, 'assigned_to');
	}

}
