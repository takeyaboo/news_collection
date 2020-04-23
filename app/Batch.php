<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Batch extends Model
{
  protected $table = 'batch';

  protected $fillable = [
      'create_num',
      'word_create_num',
      'user_id',
  ];

  public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d(D)H:i');
    }

}
