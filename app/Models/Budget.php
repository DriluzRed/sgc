<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'start_date',
        'end_date',
        'description',
        'client_id',
        'user_id',
        'status',
    ];

    CONST STATUS_PENDING = 'pending';
    CONST STATUS_APPROVED = 'approved';
    CONST STATUS_REJECTED = 'rejected';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
