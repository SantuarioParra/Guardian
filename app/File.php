<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name', 'project_id', 'minr', 'description'
    ];
    public function project(){
        return $this->belongsTo('App\Project');
    }
}
