<div class="d-flex alert alert-bleu rounded-0">

  <img class="img-50" src="{{ asset('storage/img/icones')."/".$datas->icone }}" alt="{{ $datas->icone }}">

  <h3 class="pt-3 ml-3">{{ ucfirst($datas->titre) ?? '' }}
    <small>
      @isset($datas->soustitre)

        {{ $datas->soustitre ?? ''}}
        
      @endisset
  </small>
  </h3>

</div>