<?php
namespace App\Fournisseurs;

use App\Fournisseurs\ListeFournisseur;

use App\Models\Productions\Demande;
use App\User;

/**
 *  FOURNIT LES DATAS POUR L'AFFICHAGE DE LA LISTE DES DEMANDES DANS index.blade.php
 */
class ListeDemandesFournisseur extends ListeFournisseur
{

  public function creeliste($demandes)
  {
    $this->liste = collect();

    foreach ($demandes as $demande) {

      $description = [];

      if (isset($demande->user)) {

        $eleveur = $this->lienFactory($demande->user->id, ucfirst($demande->user->name), 'eleveurAdmin.show', 'affiche_detail_eleveur');

      }

      else {

        $anonyme = User::find(0);

        $eleveur = $this->lienFactory($anonyme->id, ucfirst($anonyme->name), 'eleveurAdmin.show', 'affiche_detail_eleveur');


      }


      $analyse = $this->lienFactory($demande->id, $this->acteTypeCourt($demande->anaacte), 'demandes.show', 'affiche_detail_analyse');

      if(isset($demande->serie_id)) {

        $serie = $this->lienFactory($demande->serie->id, "n°".$demande->serie->id, 'serie.show', 'affiche_detail_serie');

      }
      else {

        $serie = $this->itemFactory('');

      }

      $espece = $this->iconeFactory($demande->espece->icone);

      $informations = $this->itemFactory($demande->informations);

      if ($demande->tovetouser_id != null) {

        $toveto = $this->lienFactory($demande->tovetouser_id, ucfirst($demande->tovetouser->name), 'vetoAdmin.show', 'affiche_veto');

      }
      else {

        $toveto =$this->itemFactory("");
      }


      $reception = $this->dateFactory($demande->date_reception);

      $terminee = $this->ouinonFactory($demande->id, $demande->acheve);

      $signe = $this->ouinonFactory($demande->id, $demande->signe);

      $envoyee = ($demande->date_envoi === null) ? $this->ouinonFactory($demande->id, false) :$this->ouinonFactory($demande->id, true);

      $facturee = $this->ouinonFactory($demande->id, $demande->facturee);

      if ($demande->facturee) {

        $facture_id = $this->lienFactory($demande->facture->id, "n°".$demande->facture->id, 'factures.show', 'affiche_facture');

      }

      else {

        $facture_id = $this->itemFactory(" - ");

      }

      $suppr = $this->delFactory($demande->id, 'demandes.destroy');

      $description = [
        $eleveur,
        $analyse,
        $informations,
        $espece,
        $toveto,
        $reception,
        $terminee,
        $signe,
        $envoyee,
        $facturee,
        $facture_id,
        $suppr,
      ];

      $this->liste->put($demande->id, $description);
    }

    return $this->liste;

  }
}
