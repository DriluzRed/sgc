<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_PAID = 'paid';
    CONST STATUS_CANCELED = 'canceled';
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'invoice_number',
        'invoice_date',
        'due_date',
        'amount',
        'client_id',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    
}
