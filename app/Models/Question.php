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


    public function questionsWithoutAnswer()
    {
        return $this->user()->questions()->whereDoesntHave('answer');
    }

    public function questionsWithAnswer()
    {
        return $this->user()->questions()->has('answer');
    }

    public function user()
    {
	    return $this->belongsTo(User::class,'id_for');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'questionlike');
    }



}