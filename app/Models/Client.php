<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Client extends Model
{
    use HasFactory;

    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,
            ClientCompany::class,
            'client_id',
            'id',
            'id',
            'company_id',
        );
    }
}
