<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_COMPLETED = 'completed';
    CONST STATUS_IN_PROGRESS = 'in_progress';

    protected $fillable = [
        'name',
        'description',
        'status',
        'due_date',
        'client_id',
        'user_id',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
