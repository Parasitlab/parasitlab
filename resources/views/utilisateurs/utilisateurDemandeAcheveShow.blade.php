<div class="col-md-4">

  <p class="color-bleu lead ">@lang('demandes.analyse')</p>

  <p class="color-bleu">@lang('demandes.recu_le') {{ \Carbon\Carbon::parse($demande->date_reception)->isoFormat('LL') }}</p>

  <p class="color-bleu">

    @lang('demandes.signe_le'){{ \Carbon\Carbon::parse($demande->date_signature)->isoFormat('LL') }} @lang('commun.par') {{ $demande->labo->user->name }}.

  </p>

  <div class="d-flex my-3">

    <div class="mr-3">

      @bouton([
        'type' => 'route',
        'route' => 'routeurResultatsPdf',
        'id' => $demande->id,
        'couleur' => 'btn-rouge',
        'fa' => 'fas fa-file-pdf',
        'intitule' => 'boutons.show_pdf',
        'target' => '_blank',
      ])

    </div>

    <div class="">

      @bouton([
        'type' => 'route',
        'route' => 'exports.demande',
        'id' => $demande->id,
        'fa' => "fas fa-table",
        'couleur' => "btn-success",
        'intitule' => __('boutons.exporter'),
        'title' => "Exporter en fichier excel",
      ])

    </div>

  </div>

</div>

<div class="col-md-7">

  <p class="color-bleu h4">@lang('demandes.results')</p>

  @include('labo.resultatsAnalyse')


</div>
