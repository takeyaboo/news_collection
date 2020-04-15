<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [
      'category_name', 'user_id','rel_word_num',
  ];

  public function getTestDataAttribute()
    {
        return $this->category_name.'('.$this->rel_word_num.'件)';
    }
}
