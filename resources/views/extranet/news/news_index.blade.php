@extends('layouts.app')

@section('menu')

  @include('labo.laboMenu')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="row my-3 justify-content-center">

      <div class="col-md-10">

        @include('fragments.flash')

      </div>

    </div>

    <div class="row my-3 justify-content-center">

      <div class="col-md-10">

        @include('extranet.news.news_choice')

      </div>

    </div>

    <div class="row my-3 justify-content-center">

      <div class="col-md-10">

        @include('admin.index.index')

      </div>

    </div>

  </div>

@endsection
