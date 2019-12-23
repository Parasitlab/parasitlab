<div class="d-flex alert alert-bleu rounded-0">

  @if(session('usertype') !== null)

    <img class="img-50" src="{{ asset('storage/img/icones')."/".session('usertype')->icone->nom}}" alt="{{session('usertype')->icone->nom}}">

    <h3 class="pt-3 ml-3">{{ ucfirst(session('usertype')->nom)}}: ajout d'un utilisateur

    </h3>

  @else

    <h3 class="pt-3 ml-3">Création d'un nouvel utilisateur</h3>

  @endif
</div>