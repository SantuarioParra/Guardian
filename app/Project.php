<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use Notifiable;

    protected $fillable = [
        'f_leader', 's_leader', 'name', 'description', 'finished_at',
    ];

    public function user(){
        return $this->belongsTo('App\User','f_leader','id');
    }

    public function files(){
        return $this->hasOne('App\File');
    }

    public function research(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
