<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
   
    protected $table = 'rezervacija';
  //  public $primarykey = 'id';
    public $timestamps = true;
    protected $fillable = [
       'ime', 'prezime', 'id_sobe', 'id_korisnika', 'dorucak', 'datum_od', 'datum_do', 'zavrsena', 'naplacena',
   ];

   public function user()
    {
        return $this->belongsTo('App\User','id_korisnika')->withDefault();
    }
  
  public function soba()
    {
        return $this->belongsTo('App\Soba','id_sobe')->withDefault();
    }
}
