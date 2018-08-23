<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soba extends Model
{
    //
    protected $table = 'sobe';
  //  public $primarykey = 'id';
    public $timestamps = true;
    protected $fillable = [
       'naziv', 'opis', 'broj_kreveta', 'slika', 'status', 'balkon', 'cistoca', 'cijena_nocenja',
   ];

   public function rezervacija()
    {
        return $this->hasOne('App\Rezervacija', 'id_sobe');
    }

}
