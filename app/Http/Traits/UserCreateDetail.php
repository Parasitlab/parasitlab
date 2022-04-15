<?php
namespace App\Http\Traits;

use App\Models\Labo;
use App\Models\Veto;
use App\Models\Eleveur;

/**
 * TRAIT DESTINE A VERIFIER LA SAISIE D UN NOUVEL UTILISATEUR POUR L ENREGISTRER
 * APPELE PAR LA METHODE STORE DE LaboAdminController, VetoAdminController et EleveurAdminController
 */
trait UserCreateDetail
{

  function laboCreateDetail($datas, $user_id)
  {

    $nouveau_labo = Labo::firstOrNew(['user_id' => $user_id]);

    $photo = 'default.jpg'; // Par défaut la photo default.jpg

    if (isset($datas['photo'])) { // Mais si un fichier a été téléchargé,
      // code...
      $datas['photo']->store('public/img/labo/photos'); // On l'enregistre

      $photo = $datas['photo']->hashname(); // et la photo prend le nom du fichier téléchargé
    }

    $signature = 'default.svg';

    if (isset($datas['imageSignature'])) {

      $datas['imageSignature']->store('public/img/labo/signatures');

      $signature = $datas['imageSignature']->hashname();

    }

    $fonction = (isset($datas['fonction'])) ? $datas['fonction'] : "";

    $signataire = (isset($datas['signataire'])) ? true : false;

    $nouveau_labo->photo = $photo;

    $nouveau_labo->signature = $signature;

    $nouveau_labo->fonction = $fonction;

    $nouveau_labo->est_signataire = $signataire;

    $nouveau_labo->save();

    return $nouveau_labo;

  }

  public function vetoCreateDetail($datas, $user_id)
  {
    $nouveau_veto = Veto::firstOrNew(['user_id' => $user_id]);

    $nouveau_veto->address_1 = $datas['address_1'];

    $nouveau_veto->address_2 = $datas['address_2'];

    $nouveau_veto->cp = $datas['cp'];

    $nouveau_veto->commune = $datas['commune'];

    $nouveau_veto->pays = $datas['pays'];

    $nouveau_veto->indicatif = ($datas['indicatif'] === null) ? 33 : $datas['indicatif'];

    $nouveau_veto->tel = $datas['tel'];

    $nouveau_veto->num = ($datas['num'] === null) ? "" : $datas['num'];

    $nouveau_veto->save();

    return $nouveau_veto;
  }

  public function eleveurCreateDetail($datas, $user_id)
  {

    $nouvel_eleveur = Eleveur::firstOrNew(['user_id' => $user_id]);

    $nouvel_eleveur->num = $datas['num'];

    $nouvel_eleveur->address_1 = $datas['address_1'];

    $nouvel_eleveur->address_2 = $datas['address_2']; // peut être null

    $nouvel_eleveur->cp = $datas['cp'];

    $nouvel_eleveur->commune = $datas['commune'];

    $nouvel_eleveur->pays = $datas['pays'];

    $nouvel_eleveur->indicatif = ($datas['indicatif'] === null) ? 33 : $datas['indicatif']; // on met l'indicatif de la France si non renseigné

    $nouvel_eleveur->tel = $datas['tel'];

    $nouvel_eleveur->veto_id = ($datas['veto_id'] == 0 || $datas['veto_id'] == "null") ? null : $datas['veto_id'];
    // si le veto est à créer (veto_id = 0) on lui met temporairement une valeur nulle (aucun vétérinaire) en attendant de créer le véto
    // Si on n'a pas saisit de valeur pour le véto, le formulaire renvoie la valeur "null" (un string) et non pas null... donc conversion

    $nouvel_eleveur->save();

    return $nouvel_eleveur;

  }
}
