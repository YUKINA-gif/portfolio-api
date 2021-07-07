<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", 
        "image",
        "github_front",
        "github_api",
        "created",
        "detail",
        "difficulties",
        "solutions",
    ];
}
