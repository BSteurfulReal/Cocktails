@extends('layouts.app')

@section('page')
  <div class="container py-5">
    <div class="card-columns">
      @foreach($cocktails as $cocktail)
        <div class="card bg-dark text-white text-center"
             onclick="window.location = '{{ route('cocktail', $cocktail->id) }}'">
          <img src="{{ $cocktail->imgUrl }}" class="card-img-top" alt="@lang('Showcase Image')">

          <div class="card-body">
            <h5 class="card-title">
              {{ $cocktail->name }}
            </h5>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
