<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests\FormulaireDemande;
use App\Http\Requests\FormulaireEnvoiPack;
use App\Http\Traits\LitJson;
use App\Http\Traits\UserTypeOutil;
use App\Http\Traits\FormatDate;

use Illuminate\Mail\Mailer;
use App\Mail\EnvoiPack;

use App\User;
use App\Models\Analyses\Anapack;
use App\Models\Analyses\Anatype;
use App\Models\Analyses\Analyse;
use App\Models\Analyses\Anaacte;
use App\Models\Productions\Demande;
use App\Models\Productions\Prelevement;
use App\Models\Productions\Signe;
use App\Models\Espece;
use App\Models\Eleveur;
use App\Models\Veto;
use App\Models\Categorie;
use App\Models\Observation;
use App\Models\Option;

class ExtranetDemandeController extends Controller
{

      use LitJson, UserTypeOutil, FormatDate;

      protected $menu;

      public function __construct()
      {
        $this->menu = $this->litJson('menuExtranet');
      }

      public function choisir()
      {
        $especes = Espece::all();

        return view('extranet.analyses.choisir', [
          'menu' => $this->menu,
          'sousmenuAnalyses' => $this->litJson('sousmenuAnalyses'),
          'especes' => $especes,
          'categories' => Categorie::all(),
          'qui_quand' => $this->litJson('qui_quand'),
          'anaactes' => Anaacte::where('estAnalyse', true)->orderBy('num')->get(),
        ]);
      }

      public function formulaireDemande($espece_id, $anatype_id)
      {
        session()->forget('demande'); // suppression de l'objet mis en session par la méthode formulaireStore

        $pays = $this->litJson("pays");

        $estParasite = $this->litJson('estParasite');

        $user = (auth()->user()) ? auth()->user() : "";

        return view('extranet.analyses.formulaireDemande', [
          'menu' => $this->menu,
          'espece_id' => $espece_id,
          'anatype_id' => $anatype_id,
          'especes' => Espece::all(),
          'anatypes' => Anatype::all(),
          'signes' => Signe::all(),
          'estParasite' => $estParasite,
          'user' => $user,
          'personne' => $this->personne(),
          'pays' => $pays,
        ]);
      }

      /*
      * Il ne s'agit pas réellement de stocker la demande d'analyse mais de metttre
      * en forme les données pour écrire le pdf téléchargeable
      */

      public function formulaireStore(FormulaireDemande $request)
      {
        $datas = $request->validated();
        // dd($datas);


        foreach ($datas as $key => $data) {
          $datas[$key] = trim(strip_tags($data));
        }
        $user = User::select('id', 'name', 'email')->where('email', $datas['email'])->first();
        if($user == null) {
            $user = new User();
            $user->id = 10000;
            $user->name = $datas['name'];
            $user->email = $datas['email'];
            $user->usertype = $this->userTypeEleveur()->id;
            $eleveur = new Eleveur();
            $eleveur->user_id = $user->id;
            $eleveur->address_1 = $datas['address_1'];
            $eleveur->address_2 = $datas['address_2'];
            $eleveur->cp = $datas['cp'];
            $eleveur->commune = $datas['commune'];
            $eleveur->indicatif = $datas['indicatif'];
            $eleveur->tel = $datas['tel'];
            $eleveur->num = $datas['num'];
        } else {
          $eleveur = Eleveur::where('user_id', $user->id)->first();
        }

        $demande = new Demande();
        $demande->id = 10000;
        $demande->user_id = $user->id;
        $demande->nb_prelevement = intVal($datas['nb_prelevement']);
        $demande->espece_id = $datas['espece_id'];
        $demande->anaacte_id = $datas['anaacte_id'];
        $demande->informations = $datas['informations'];
        $demande->date_prelevement = $this->dateReadable($datas['date_prelevement']);
        $demande->toveto = ($datas['veto'] == null) ? false : true;
        $demande->veto = $datas['veto'];

        $prelevements = Collect();

        for ($i=1; $i < $datas['nb_prelevement'] + 1 ; $i++) {

              $prelevement = Collect();
              $prelevement->identification = ($datas['p_'.$i]== null) ? "lot n°".$i : $datas['p_'.$i];
              $prelevement->parasite = $datas['parasite_'.$i];

              $liste_signes = Signe::all();
              $signes = Collect();

              $prelevement->put('signes', $signes);

              foreach ($liste_signes as $signe) {

                if(isset($datas['signe_'.$i.'_'.$signe->id])) {

                  $prelevement['signes']->push($signe->nom);

                }

              }
              $prelevements->push($prelevement);
        }
        $demande->prelevements = $prelevements;
        $demande->user = $user;
        $demande->eleveur = $eleveur;

        session(['demande' =>$demande]);

        return redirect()->route('formulaire');

       }

       /*
       * Page de formulaire de demande d'envoi d'un pack
       */
       public function envoiPack()
       {

         $cout_pack = Anaacte::select('pu_ht')->where('abbreviation', 'kit envoi')->first()->pu_ht;

         return view('extranet.analyses.enpratique.envoiPack', [
           'menu' => $this->menu,
           'pays' => $this->litJson('pays'),
           'user' => auth()->user(),
           'personne' => $this->personne(),
           'cout_pack' => $cout_pack,
         ]);
       }

       /*
       * Récupération des données du formulaire ci-dessus
       */
       public function envoiPackStore(FormulaireEnvoiPack $request)
       {

         $demande = $request->validated();

         $mail = Mail::to(config('mail')['from']['address'])->send(new EnvoiPack($demande));

         return view('extranet.analyses.enpratique.envoiPackOk');

       }

       public function observationSelonEspece($espece_id)
       {

         $observations = DB::table('observations')
                          ->join('espece_observation', 'espece_observation.observation_id', "=", 'observations.id')
                          ->where('espece_observation.espece_id', $espece_id)
                          ->orderBy('observations.ordre')->get();

         return json_encode($observations);
       }

       // Issu du choisir.js
       // Renvoie la liste des analyses proposées selon l'espece et une liste d'observations
       // Utilise les tables pivot espece_observation et anaacte_observation
       // renvoie un json avec seulement les analyses les plus fréquentes
       // Une manip permet de remonter le score des deux analyses particulières (haemonchus et resistance)
       // public function analyseSelonObservations($espece_id, $liste)
       // {
       //   // On récupère toutes les observations
       //   $observations = Observation::find(explode('_', $liste));
       //
       //   $liste_anatypes = Analyse::select('anatype_id')->where('espece_id', $espece_id)->get();
       //   $types = Collect();
       //
       //   foreach ($liste_anatypes as $anatype) {
       //     $types->push($anatype->anatype_id);
       //   }
       //
       //   $nb_observation = count(explode(',', $liste));
       //
       //   // On crée une nouvelle collection
       //   $analyses = Collect();
       //   // Qu'on peuple en passant en revue les différentes observations
       //   foreach ($observations as $observation) {
       //     // Les analyses attachées à ces observations
       //     foreach ($observation->anaactes as $anaacte) {
       //       if($types->contains($anaacte->anatype->id)) {
       //
       //         $item = Collect(); // Nouvelle collection pour chaque analyse
       //         $item->put("type",$anaacte->anatype->nom); // On y met le nom du type
       //         $item->put("acte", $anaacte->nom); // On y met le détait (anaacte)
       //         $item->put("estSpecial", $anaacte->anatype->estSpecial ); // on rajoute l'attribut de certains types (résitances, haemonchus),
       //         $item->put("id" ,$anaacte->id); // Et l'id
       //         $analyses->push($item); // Et on rentre tout ça dans la collection initiale
       //       }
       //     }
       //   }
       //
       //  $freq_analyses = $analyses->countBy('id')->values(); // On crée une nouvelle collection qui compte la fréquence de chaque analyse
       //  $freq_analyses_max = $freq_analyses->max();
       //  $analyses_uniques = $analyses->unique()->values(); // On élimine les doublons
       //
       //  // et on assoocie les deux collections
       //  for ($i=0; $i < $freq_analyses->count() ; $i++) {
       //
       //    $analyses_uniques[$i]->put("nb", $freq_analyses[$i]);
       //      $analyses_uniques[$i]->put("max", $freq_analyses_max);
       //
       //  }
       //  $analyses_ponderees = $analyses_uniques->map(function($item, $key) {
       //    if($item['estSpecial'] == 1) {
       //      $item->estSpecial = $item['max'];
       //
       //    }
       //    return $item;
       //  });
       //
       //  $synthese = $analyses_ponderees->whereBetween("nb", [$freq_analyses_max-1, $freq_analyses_max]);
       //
       //   return json_encode($synthese->groupBy("type"));
       // }

       // public function optionsSelonObservations($espece_id, $liste)
       // {
       //   // On recherche d'abord les anaactes acceptés pour l'espece
       //   $espece = Espece::find($espece_id);
       //
       //   $anaactes = $espece->anaactes;
       //   $liste_anaactes_espece = Collect();
       //   foreach ($anaactes as $anaacte) {
       //        $liste_anaactes_espece->push($anaacte->id);
       //   }
       //
       //   // Puis on recherches les options et les anaactes permis par les observations
       //   $observations = [ 1, 15, null];
       //   $liste_options = Collect();
       //   $liste_anaactes = Collect();
       //
       //   foreach ($observations as $observation_id) {
       //
       //     if(isset($observation_id)) {
       //
       //       $observation = Observation::find($observation_id);
       //
       //       foreach ($observation->options as $option) {
       //
       //         foreach($option->anaactes as $anaacte) {
       //
       //           $liste_anaactes->push($anaacte->id);
       //
       //         }
       //
       //         $liste_options->push($option->nom);
       //
       //       }
       //
       //       foreach ($observation->anaactes as $anaacte) {
       //
       //         $liste_anaactes->push($anaacte->id);
       //
       //       }
       //     }
       //   }
       //   $resultats = Collect();
       //   // On élimine les doublons (countBy), on trie en descendant(sort et inverse), et on garde que les deux premières clefs ( keys: n° anaacte les plus fréquants)
       //   // après avoir gardé que les anaactes qui sont aussi présent dans la liste des especes (intersect)
       //   $resultats->put("options", $liste_options->countBy()->sort()->reverse()->slice(0,2)->keys());
       //   // A peu près idem avec les options (sauf qu'il n'y a pas d'intersect);
       //   $resultats->put("anaactes",$liste_anaactes->intersect($liste_anaactes_espece)->countBy()->sort()->reverse()->slice(0,2)->keys());
       //
       //   return json_encode($resultats);
       // }

       public function options(Request $request)
       {
         $datas = $request->all();

         // On récupère l'espece
         $espece = Espece::find($datas['espece']);

         // On recherche d'abord les anaactes acceptés pour l'espece (table pivot anaacte_espece)
         $anaactes = $espece->anaactes;
         $liste_anaactes_espece = Collect();
         foreach ($anaactes as $anaacte) {
              $liste_anaactes_espece->push($anaacte->id);
         }

         // On récupère les observations dans une collection avec 3 item: 1 pour chaque catégorie d'observation
         // (signe, action, situation) sachant qu'il peut y en avoir un ou deux null
         $observations = Collect();
         for ($i=1; $i < Categorie::count()+1  ; $i++) {
           // ces trois id d'observation sont stockées dans la collection $observations
           $observations->push($datas['categorie_'.$i]);
         }
         // Puis on recherches les options et les anaactes permis par les observations
         $liste_options = Collect();
         $liste_anaactes = Collect();
         // On passs en revue la collection $observations
         foreach ($observations as $observation_id) {
           // Si cette observation n'est pas nulle
           if(isset($observation_id)) {
             // On la recherche dans la base de donnée
             $observation = Observation::find($observation_id);
             // Et on passe en revue les options possibles avec cette observation (table pivot observation_option)
             foreach ($observation->options as $option) {
               // Si au moins une option existe pour cette observation
               if(isset($option->nom)) {
                 // on passe en revue les anaactes permis par cette option (table pivot anaacte_option)
                 foreach($option->anaactes as $anaacte) {
                   // Et on ajoute l'id de l'anaacte à la liste
                   $liste_anaactes->push($anaacte->id);
                 }
                 // Et on ajoute l'option à la liste d'options
                 $liste_options->push($option->nom);
               }
             }
             // On passe en revue tous les anaactes permis par l'observation (table pivot anaacte_observation)
             foreach ($observation->anaactes as $anaacte) {
               // Et on continue l'ajout dans la liste des anaactes
               $liste_anaactes->push($anaacte->id);
             }
           }
         }
         // On crée la collection qui sera transmise en réponse à la requête ajax
         $resultats = Collect();
         // On élimine les doublons (countBy), on trie en descendant(sort et inverse), et on garde que les deux premières clefs ( keys: n° option les plus fréquants)
         $resultats->put("options", $liste_options->countBy()->sort()->reverse()->slice(0,2)->keys());
         // On ne garde que les anaactes de la liste $liste_anaactes qui sont aussi présents dans la liste des especes (intersect)
         // On élimine les doublons (countBy), on trie en descendant(sort et inverse), et on garde que les deux premières clefs ( keys: n° anaacte les plus fréquants)
         $resultats->put("anaactes",$liste_anaactes->intersect($liste_anaactes_espece)->countBy()->sort()->reverse()->slice(0,2)->keys());

         return json_encode($resultats);


       }

}
