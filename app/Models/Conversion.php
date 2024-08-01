<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'conversion';
    protected $fillable = ['type', 'unit'];
}
