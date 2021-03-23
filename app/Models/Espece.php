<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Espèce animale élevée est sur les prélèvement de laquelle sont faites les analyses
 *
 * Est lié à de nombreux autres modèles
 * - Icone (belongsTo): une espèce à une Icone
 * - Age (hasMany): une espèce peut avoir différents Age (jeunes, adultes, ...)
 * - Analyses (hasMany): une espèce est concernée par plusieurs analyses possibles
 * - Demande (hasMany): dans une demande d'analyse, l'espèce est toujours définie
 * - Serie (hasMany): une série est une demande d'analyse qui se répète (test de résistance par ex)
 * - Anatype:
 * - Observation:
 * - Exclusion:
 * - ObservationAnaacte
 * - Typeprod:
 * @package Animaux
 */
class Espece extends Model
{
    public $timestamps = false;

    public function icone()
    {
      return $this->belongsTo(Icone::class);
    }

    public function ages()
    {
      return $this->hasMany(Age::class);
    }

    public function analyses()
    {
      return $this->hasMany(Analyses\Analyse::class);
    }

    public function demandes()
    {
      return $this->hasMany(Productions\Demande::class);
    }

    public function serie()
    {
      return $this->hasOne(Labo\Serie::class);
    }

    public function anatypes()
    {
      return $this->belongsToMany(Analyses\Anatype::class);
    }

    public function observations()
    {
      return $this->belongsToMany(Algorithme\Observation::class);
    }

    public function exclusion()
    {
      return $this->hasOne(\App\Models\Algorithme\Exclusion::class);
    }

    public function exclusionsAnaacte()
    {
      return $this->hasOne(\App\Models\Algorithme\ExclusionsAnaacte::class);
    }

    public function typeprods()
    {
      return $this->hasMany(Typeprod::class);
    }

    public function troupeaus()
    {
      return $this->hasMany(Troupeau::class);
    }
}
