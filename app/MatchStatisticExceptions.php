<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchStatisticExceptions extends Model
{
    //
    protected $table = 'match_statistic_exceptions';

    protected $fillable = ['device', 'android', 'title', 'content'];
}
