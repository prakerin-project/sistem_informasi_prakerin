<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprog extends Model
{
    use HasFactory;

    protected $table = 'kaprog';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];

    public $timestamps = false;
}
