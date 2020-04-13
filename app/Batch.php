<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
  protected $table = 'batch';

  protected $fillable = [
      'create_num',
      'word_create_num',
  ];
}
