<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'ruc'];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function budgets()
    {
        return $this->hasMany('App\Models\Budget');
    }
}
