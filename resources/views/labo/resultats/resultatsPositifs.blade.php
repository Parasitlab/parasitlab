<table class="table table-bordered table-hover">

  @include('labo.resultats.titreResultat')

  <tbody>
    @foreach ($prelevement->resultats as $resultat)

        <tr>

          <td>{{ ucfirst(__($resultat->anaitem->nom)) }}</td>

          <td class="text-right">{{ $resultat->valeur }} {{ $resultat->anaitem->unite->nom }}</td>

        </tr>

    @endforeach

    @if (count($prelevement->nonDetecte) > 0)

      @include('labo.resultats.listeNonDetecte')

    @endif

  </tbody>

</table>
