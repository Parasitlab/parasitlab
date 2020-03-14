<?php

namespace App\Http\Controllers\Technique;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Traits\LitJson;

class ParasitismeController extends Controller
{

      use LitJson;

      protected $menu;

      public function __construct()
      {
        $this->menu = $this->litJson('menuExtranet');
      }

      public function accueil()
      {
        return view('extranet.technique.parasitisme.parasitisme', [
          "menu" => $this->menu,
        ]);
      }

      public function resistances()
      {
        return view('extranet.technique.parasitisme.resistances', [
          'menu' => $this->menu,
        ]);
      }

      public function surdispersion()
      {
        return view('errors.entravaux');
      }

      public function entomofaune()
      {
        return view('extranet.technique.parasitisme.entomofaune', [
          'menu' => $this->menu,
        ]);
      }

}
