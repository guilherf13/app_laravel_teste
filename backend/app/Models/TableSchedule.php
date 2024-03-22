<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSchedule extends Model
{
    use HasFactory;

    protected $table = 'table_schedule';

    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'cpf',
        'phone'
    ];
}
