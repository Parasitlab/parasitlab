{{-- issu du tableau listant les anaitems (cad la liste des parasites recherchés) --}}
@extends('layouts.app')

@section('menu')

  @include('labo.laboMenu')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="row justify-content-center my-3">

      <div class="col-md-11 col-lg-10 col-xl-9">

        @titre(['titre' => ucfirst($anaitem->nom), 'icone' => 'oeufs/'.$anaitem->image])

      </div>

    </div>

    <div class="row justify-content-center">

      <div class="col-md-11 col-lg-10 col-xl-9">
        {{-- formulaire de modification d'un anaitem --}}
        <form id="form_anaitem" action="{{ route('anaitems.update', $anaitem->id) }}" method="post" enctype="multipart/form-data" >

          @csrf

          @method('PUT')

            <div class="form-row">

              <div class="form-group col-md-4">
                {{-- champs abbréviation --}}
                <label for="abbreviation">@lang('form.abbr')</label>
                <input type="text" class="form-control" name="abbreviation" maxlength="4" value="{{ old('abbreviation') ?? $anaitem->abbreviation }}">

              </div>

              <div class="form-group col-md-8">
                {{-- champs nom --}}
                <label for="nom">@lang('form.nom')</label>
                <input type="text" class="form-control" name="nom" value="{{ old('nom') ?? $anaitem->nom }}">

              </div>

            </div>

            <div class="form-row">
              {{-- champs unite --}}
              <div class="form-group col">
                <label for="unite">@lang('form.unites')</label>
                <select id="unite" name="unite" class="form-control">

                  @foreach ($unites as $unite)

                    @if ($anaitem->unite_id == $unite->id)

                      <option value = "{{ $unite->id }}" selected>@lang($unite->type) : @lang($unite->nom)</option>

                    @endif

                    <option value = "{{ $unite->id }}" >@lang($unite->type) : @lang($unite->nom)</option>

                  @endforeach

                </select>

              </div>


              <div class="form-group col">
                {{-- type d'unité valeur, estimation, presence  --}}
                <label for="qtt">@lang('form.valeurs')</label>
                <select id="qtt" name="qtt" class="form-control">

                  @foreach ($qtts as $qtt)

                    @if ($anaitem->qtt_id == $qtt->id)

                      <option value="{{ $qtt->id }}" selected>@lang($qtt->nom)</option>

                    @else

                      <option value="{{ $qtt->id }}">@lang($qtt->nom)</option>

                    @endif

                  @endforeach

                </select>

              </div>


                <div id="multiple" class="form-group col collapse">

                  <label for="multiple">Multiple pour obtenir les opg</label>

                  <input class="form-control" type="number" min=1 step=1 name="multiple" value="{{ $anaitem->multiple }}">

                </div>


            </div>

            <div class="form-row">

              <div class="col-md-12">

                @inputImage( [
                  'nouveau' => $nouveau,
                  'image' => $anaitem->image ,
                  'chemin' => 'storage/img/icones/oeufs/',
                  'name' => 'image'
                ])

              </div>

            </div>

            <div id="anaitem_enregistre">

              @enregistreAnnule(['route' => route('anaitems.index')])

            </div>

        </form>

      </div>

      <div class="col-md-4 col-lg-4 col-xl-4 border-left">

        @include('admin.anaitems.uniteCreate')

      </div>

    </div>

  </div>

@endsection

@section('scripts')

  <script src="{{url('js/anaitem.js')}}"></script>

@endsection
