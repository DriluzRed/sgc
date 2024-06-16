<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'ruc'];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}
