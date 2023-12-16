<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestContent extends Model
{
    use HasFactory;
    protected $table = 'test_contents';

    protected $fillable = ['title', 'description'];
}
