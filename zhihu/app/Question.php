<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body','userId'];

    public function topics()
    {
        return $this->belongsToMany(Topic::class,'question_topic','questionId','topicId')->withTimestamps();
    }
}
