<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCompany extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = false;

    protected $fillable = [
        'client_id',
        'company_id',
    ];
}
