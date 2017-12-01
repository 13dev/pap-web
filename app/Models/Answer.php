<?php
/**
 * User: xdoser
 * Date: 26-11-2017
 * Time: 18:02
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';

    protected $fillable = [
        'text',
        'likes',
    ];

    public function question()
    {
        return $this->hasOne(Question::class);
    }

}