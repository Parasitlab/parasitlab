<?php
namespace App\Http\Traits;

use App\Http\Traits\LitJson;
use App\Http\Traits\ListeItemFactory;

use App\Models\Productions\Demande;

/**
 *  FOURNIT LES DATAS POUR L'AFFICHAGE DE LA LISTE DES DEMANDES DANS index.blade.php
 */
trait ListeDemandeFournisseur
{

  use LitJson, ListeItemFactory;

  protected $datas;

  protected $liste;


  public function datas()
  {
    $demandes = Demande::all();

    $this->datas = collect();

    $this->datas->titre = "liste des demandes d'analyse";

    $this->datas->icone = "demandes.svg";

    $this->datas->intitules = $this->litJson('tableauDemandes');

    $this->datas->liste = $this->liste($demandes);

    return $this->datas;
  }

  public function liste($demandes)
  {
    $this->liste = collect();

    foreach ($demandes as $demande) {

      $description = [];

      $eleveur = $this->itemFactory('lien', $demande->user->id, $demande->user->name, 'eleveurAdmin.show');

      $analyse = $this->itemFactory('lien', $demande->id, $demande->anapack->nom, 'demandes.show');

      if(isset($demande->serie_id)) {

        $serie = $this->itemFactory('lien', $demande->serie->id, $demande->serie->id, 'serie.show');

      }
      else {
        $serie = '';
      }

      $espece = $this->itemFactory('icone', $demande->espece->id, $demande->espece->icone, null);

      $toveto = $this->itemFactory('lien', $demande->toveto->user->id, $demande->toveto->user->name, 'vetoAdmin.show');

      $reception = $this->itemFactory(null, null, $demande->reception, null);

      $terminee = $this->itemFactory('ounon', null, $demande->acheve, null);

      $facture = $this->itemFactory('lien', $demande->facture->id, "n°".$demande->facture->id, 'home');

      $suppr = $this->itemFactory('del', $demande->id, null, 'demandes.destroy');

      $description = [
        $eleveur,
        $analyse,
        $serie,
        $espece,
        $toveto,
        $reception,
        $terminee,
        $facture,
        $suppr,
      ];

      $this->liste->put($demande->id, $description);
    }

    return $this->liste;

  }
}
