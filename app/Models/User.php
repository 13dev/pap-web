<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	protected $table = 'user';

	protected $fillable = [
		'username',
		'firstname',
		'lastname',
        'email',
		'password',
		'avatar',
		'points',
		'likes',
        'followers',
	];

	public function setPassword($password)
    {
		return $this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT),
		]);
	}
	
    public function unreadQuestions()
    {
        return $this->questions()->where('read', 0);
    }

    public function readQuestions()
    {
        return $this->questions()->where('read', 1);
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'id_for');
    }
}