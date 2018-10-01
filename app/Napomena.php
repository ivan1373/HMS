<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Napomena extends Model
{
    //
     protected $table = 'napomene';
     public $timestamps = true;
     
       protected $fillable = [
          'naslov', 'sadrzaj',  'id_korisnika', 'procitana',
      ];

    public function user()
    {
        return $this->belongsTo('App\User','id_korisnika')->withDefault();
    }
}
