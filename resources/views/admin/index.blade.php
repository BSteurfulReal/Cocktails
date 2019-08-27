@extends('layouts.admin')

@php
  $cocktailCount = $data['cocktailCount'] ?? 0;
  $ingCount = $data['ingredients']['ingCount'] ?? 0;
  $pumpCount = $data['ingredients']['pumpCount'] ?? 0;
@endphp

@section('page')
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-md-8">
        <div class="card bg-info text-light">
          <div class="card-header">
            @lang('Dashboard')
          </div>

          <div class="card-body">
            @if(session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            @lang('Je bent ingelogd!')
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card bg-dark text-light h-100">
          <div class="card-header">
            @lang('Cocktails')
          </div>

          <div class="card-body">
            Er {{ $cocktailCount == 1 ? 'is 1 cocktail' : "zijn $cocktailCount cocktails" }} beschikbaar.
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card bg-dark text-light h-100">
          <div class="card-header">
            @lang('Dranken')
          </div>

          <div class="card-body">
            <p>
              Er {{ $ingCount == 1 ? 'is 1 drank' : "zijn $ingCount dranken" }} beschikbaar
              en {{ $pumpCount == 1 ? '1 pomp' :  "$pumpCount pompen" }} ingebruik.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
