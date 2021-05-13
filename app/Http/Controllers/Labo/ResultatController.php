<?php

namespace App\Http\Controllers\Labo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Labo\CommentaireController;
use Illuminate\Http\Request;
use DB;

use App\Http\Traits\LitJson;
use App\Http\Traits\LitCsv;

use App\Models\Productions\Demande;
use App\Models\Productions\Prelevement;
use App\Models\Productions\Resultat;
use App\Models\Productions\Commentaire;

class ResultatController extends Controller
{
  use LitJson, LitCsv;

  protected $menu;

  public function __construct()
  {
    $this->menu = $this->litJson("menuLabo");

  }

  /*
  * SAISIE OU MODIFICATION DES RESULTATS
  */

  public function edit($demande_id)
  {

    $demande = Demande::find($demande_id);

    $commentaire = Commentaire::where('demande_id', $demande_id)->first();

    $prelevements = Prelevement::where('demande_id', $demande_id)->get();

    return view('labo.resultats.resultatsSaisie', [
      'menu' => $this->menu,
      'prelevements' => $prelevements,
      'demande' => $demande,
      'commentaire' => $commentaire,
    ]);
  }

  /*
  * STOCKAGE DES RESULTATS: issu du formulaire vue: resultatsSaisie.blade.php
  */

  public function store(Request $request)
  {

    $datas = $request->all();
// dd($datas);
    // ON PASSE EN REVUE LA VARIABLE DATAS POUR EN EXTRAIRE TOUTES LES VALEURS SAISIES
    foreach ($datas as $intitule => $valeur) {
      // ON EXPLODE CAR LES VALEURS SONT SOUS LA FORME resultat_id du prélèvement__id_de l'anaitem (ex: resultat_2_4)
      $tableau_valeur = explode('_', $intitule);
      // ON CONTROLE QU'IL SAGIT BIEN D'UN RESULTAT
      if (isset($tableau_valeur[0]) && $tableau_valeur[0] == "resultat") {
        // ON ASSOCIE LES VALEURS AU prelevement_id ET anaitem_id
        $prelevement_id = $tableau_valeur[1];

        $anaitem_id = $tableau_valeur[2];

        // si cette valeur est supérieure à zéro ou vaut présence on la saisie dans le résultat (ou on la met à jour si elle existe)
        if ($valeur === "Absence" || $valeur === null || $valeur === "-" || $valeur === "0") {

          $valeur = ($valeur === null) ? 0 : $valeur ;

          $resultat = Resultat::updateOrCreate(['prelevement_id' => $prelevement_id, 'anaitem_id' => $anaitem_id], ['valeur' => $valeur, 'positif' => '0']);

        }
        /* Comme c'est un formulaire pour saisir ET modifier, si une valeur est null ou égale à 0
        * il faut vérifier si elle n'existe pas déjà dans le tableau des résultats
        */
        else {

          $resultat = Resultat::updateOrCreate(['prelevement_id' => $prelevement_id, 'anaitem_id' => $anaitem_id], ['valeur' => $valeur, 'positif' => '1']);

        }

      }

    }

    return redirect()->route('demandes.show', $datas['demande_id']);

  }

  public function commentaire(Request $request)
  {
  }

  // Cloture d'une saisie de résultats quand elle est achevée (bouton cloture dans demandeShow)
  public function cloture($demande_id)
  {

    DB::table('demandes')->where('id', $demande_id)->update(['acheve' => true, 'date_resultat' => date("Y-m-d H:i:s")]);

    return redirect()->back();

  }

  public function rouvrir($demande_id)
  {

    DB::table('demandes')->where('id', $demande_id)->update(['acheve' => false, 'date_resultat' => null]);

    return redirect()->back();
  }
}
