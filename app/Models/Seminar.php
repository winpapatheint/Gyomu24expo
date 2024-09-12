<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'joinlist',
		'start',
		'end',
		'description',
		'starturl',
		'joinurl',
		'semtype_id',
		'open',
		'fee',
		'limit',
		'testminute',
		'testquestion',
		'passcode',
		'passkey',
		'formurl',
		'zoomapi',
		'host_id'
    ];

}
