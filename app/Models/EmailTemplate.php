<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'email_templates';

    // Specify the attributes that are mass assignable
    protected $fillable = ['name', 'content'];

    // Optionally, if you want to use timestamps
    public $timestamps = true; // This is true by default, but can be explicitly defined
}
