<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $fillable = [
      'user_id', 'mail_address', 'mail_flg', 'batch_flg', 'graph_flg',
    ];
}
