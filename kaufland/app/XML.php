<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class XML extends Authenticatable
{
    protected $guard = 'xml_datas';

    protected $fillable = [
        'xml_data', 'Source',
    ];

  
}
