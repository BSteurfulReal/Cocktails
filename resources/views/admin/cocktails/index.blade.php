@extends('layouts.admin')

@section('styles')
  <style>
    tr:first-child {
      width: 200px;
    }

    tr:not(:first-child) {
      width: calc(100% - 200px);
    }
  </style>
@endsection

@section('page')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-info">
          <div class="card-header bg-primary text-light">
            @lang('Cocktails')
          </div>

          <table class="card-body table table-dark table-striped table-hover mb-0">
            <thead>
            <tr>
              <th class="th_img" scope="col">@lang('Afbeelding')</th>
              <th scope="col">@lang('Naam')</th>
            </tr>
            </thead>

            <tbody>
            @foreach($cocktails as $cocktail)
              <tr onclick="window.location = '{{ route('cocktails.show', $cocktail) }}'">
                <th class="th_img" scope="row">
                  <img class="img-thumbnail"
                       src="{{ asset($cocktail->imgUrl) }}"
                       alt="@lang('No image')">
                </th>
                <td>{{ $cocktail->name }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <div class="card-footer">
            <a class="btn btn-primary float-right"
               href="{{ route('cocktails.create') }}">
              <i class="fas fa-plus"></i> @lang('Toevoegen')
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
