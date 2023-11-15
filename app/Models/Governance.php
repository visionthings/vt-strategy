<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governance extends Model
{
    use HasFactory;
    protected $fillable  = [
        'section_description',
        'description_one',
        'description_two',
        'description_three',
        'status',
    ];
    
}
