<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'question';

	protected $fillable = [
		'text',
		'id_from',
		'id_for',
        'hidden',
		'points',
	];

    public function user()
    {
	    return $this->hasOne(User::class,'id');
    }

}