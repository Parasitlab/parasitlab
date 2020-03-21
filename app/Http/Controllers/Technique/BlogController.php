<?php

namespace App\Http\Controllers\Technique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


use App\Http\Traits\LitJson;
use App\Http\Traits\UserTypeOutil;
use App\Http\Traits\BlogManager;

use App\User;
use App\Models\Parasitisme\Blog;
use App\Models\Parasitisme\Motclef;

class BlogController extends Controller
{
    use LitJson, UserTypeOutil, BlogManager;

    protected $menu;

    public function __construct()
    {
      $this->menu = $this->litJson('menuExtranet');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('parasitisme');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $laboratoires = User::where('usertype_id', $this->userTypeLabo()->id)->get();

      $blog = new Blog();

      $route = ['blog.store'];

      $method = "POST";

        return view('extranet.technique.blog.createEdit', [
          'menu' => $this->menu,
          'laboratoires' => $laboratoires,
          'blog' => $blog,
          'route' => $route,
          'method' => $method,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
          'titre' => 'required|unique:blogs|max:191',
          'contenu' => 'required',
          'auteur' => 'required',
          'image' => 'file|image|required',
          'motclefs' => '',
        ]);

        $nouveau_blog = new Blog;

        $fichier_image = $request->file('image');

        $nouvelle_image = $fichier_image->store('img/blog', 'public');

        $this->storeUpdate($nouveau_blog, $validateData, $nouvelle_image);

        return redirect()->route('parasitisme');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $laboratoires = User::where('usertype_id', $this->userTypeLabo()->id)->get();

      $blog = Blog::find($id);

      $motclefs = $blog->motclefs;

      $liste_motclefs = "";

      foreach ($motclefs as $motclef) {

        $liste_motclefs .= $motclef->motclef.'; ';
      }

      $route = ['blog.update', $id];

      $method = 'PUT';

      return view('extranet.technique.blog.createEdit', [
        'menu' => $this->menu,
        'blog' => $blog,
        'liste_motclefs' => $liste_motclefs,
        'route' => $route,
        'method' => $method,
        'laboratoires' => $laboratoires
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validateData = $request->validate([
        'titre' => 'required|max:191',
        'contenu' => 'required',
        'auteur' => 'required',
        'image' => 'file|image',
        'motclefs' => '',
      ]);

      $blog = Blog::find($id);
      // Mise à jour des mots clefs et suppression de ceux qui en sont plus utilisés
      $blog->motclefs()->detach();

      $fichier_image = (null !== $request->file('image')) ? $request->file('image') : false;

      $nouvelle_image = ($fichier_image) ? $fichier_image->store('img/blog', 'public') : false;

      // Suppression du fichier image si celle-ci est changée
      if($nouvelle_image) {

        $this->supprImage($blog->image);

      }

      $this->storeUpdate($blog, $validateData, $nouvelle_image);

      return redirect()->route('blog.index')->with('message', 'blog_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $blog = Blog::find($id);

      // Supprimer le fichier image TRAIT BLOGMANAGER
      $this->supprImage($blog->image);
      // supprimer le blog
      Blog::destroy($id);

      $this->supprMotclefsOrphelins();

      return redirect()->route('parasitisme')->with('message', 'blog_destroy');
    }

    /*
    * FONTION DESTINEE A STOCKER UN NOUVEAU BLOG OU A METTRE A JOUR UN BLOG EXISTANT
    * TOUT EN STOCKANT LES MOTS-CLEFS ET EN NETTOYANT LA BASDE DE MOTS CLEFS S'ILS NE SONT ATTACHÉS À AUCUN Blog
    * FONTION APPELEE PAR blog.store et blog.update
    */

    public function storeUpdate($blog, $validateData, $nouvelle_image)
    {

      // Elimination des motclefs sans article TRAIT BLOGMANAGER
      $this->supprMotclefsOrphelins();

      // STOCKAGE OU UPDATE DU BLOG
      $blog->titre = $validateData['titre'];
      $blog->contenu = nl2br($validateData['contenu']);
      $blog->user_id = $validateData['auteur'];
      $blog->image = ($nouvelle_image) ? explode('/', $nouvelle_image)[2] : $blog->image;

      $blog->save();

      // STOCKAGE DES MOTS CLEFS
      $tableau_motclefs = preg_split("/[,;]+/", $validateData['motclefs']);

      foreach ($tableau_motclefs as $motclef) {

        if(preg_match('/[a-zA-Z]+/', $motclef)) {

          $motclef = Motclef::firstOrCreate(['motclef' => trim($motclef)]);

          $blog->motclefs()->attach($motclef->id);

        }

      }

    }
}
