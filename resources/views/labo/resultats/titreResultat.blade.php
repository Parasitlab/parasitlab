

<div class="card-header alert-bleu-tres-fonce d-flex justify-content-between">

  {{-- Titre du prélèvement avec le numéro et le nom de l'animal --}}
  <h5 class="">{{ ucfirst($titre ?? '') }} {{ ucfirst($soustitre ?? '') }}</h5>

  {{-- Boutons de modification et suppression du prélèvement si analyse non signée--}}
  @if (!$prelevement->demande->signe) {{-- si la demande de prélèvement n'a pas été signée, possibilité de modifier les prélèvements --}}

    <div class="d-flex">

      @isset ($nouveau) {{-- si c'est un prélèvement non renseigné, affichage d'un bouton + --}}

        @if($nouveau)
          
          <a class="mr-3"  href="{{ route('prelevement.createOne', [$prelevement->demande->id, $rang]) }}">

            <i class="fas fa-plus-square text-warning"></i>

          </a>

          <a class="mr-3"  href="{{ route('prelevement.prelevdel', $prelevement->id) }}">

            <i class="fas fa-trash-alt text-danger"></i>

          </a>

        @else {{-- sinon affichage d'un bouton edit --}}

          <a class="mr-3"  href="{{ route('prelevement.edit', $prelevement->id) }}">

            <i class="fas fa-edit text-success"></i>

          </a>

          <a class="mr-3"  href="{{ route('prelevement.prelevdel', $prelevement->id) }}">

            <i class="fas fa-trash-alt text-danger"></i>

          </a>

        @endif

      @endisset

    </div>

  </div>

@endif
