@extends('layouts.admin')

@php($show = isset($cocktail))

@section('scripts')
  <script type="application/javascript" defer>
    window.onload = function () {
      $('#imageFile').on('change', function (e) {
        e.preventDefault();

        let parts = $(this).val().split('\\');
        let filename = parts [parts.length - 1];

        $('#imageFileText').html(filename);
        $('#imgChanged').val('true');
      });
    };

    function addIngredient(id) {
      $.post('{{ route('ingredients.add') }}', {'id': id}).done(function (data) {
        $('#ingredients').append(data);
      }).fail(function (data) {
        console.log(data)
      });
    }

    function removeIngredient(btn) {
      $(btn).parentsUntil('#ingredients').remove();
    }
  </script>
@endsection

@section('styles')
  <style>
    #imageFileWrapper > #imageFileText::after {
      content: "@lang('Bladeren')";
    }

    #ingredients .list-group-item {
      margin: 0;
      padding: 0;
      border: none;
    }

    #ingredients .list-group-item:not(:first-child) .input-group-text {
      border-top-left-radius: 0;
    }

    #ingredients .list-group-item:not(:first-child) .btn {
      border-top-right-radius: 0 !important;
    }
  </style>
@endsection

@section('modals')
  @if($show)
    <div class="modal fade"
         id="destroy"
         tabindex="-1"
         role="dialog"
         aria-labelledby="destroyLabel"
         aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-header bg-danger rounded-0 text-light">
            <h5 class="modal-title" id="destroyLabel">
              @lang('Cocktail verwijderen')
            </h5>

            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="{{ route('cocktails.destroy', $cocktail) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-body">
              <p class="mb-0">
                @lang('Weet je zeker dat je deze cocktail wilt verwijderen?')
              </p>
            </div>

            <div class="modal-footer bg-dark rounded-0">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Annuleer')</button>

                <button type="submit" class="btn btn-danger">@lang('Verwijderen')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endif
@endsection

@section ( 'page' )
  <div class="container">
    <form action="{{ $show ? route('cocktails.update', $cocktail) : route('cocktails.store') }}"
          method="POST" enctype="multipart/form-data">
      @method($show ? 'PATCH' : 'POST')
      @csrf

      <input type="hidden" id="imgChanged" name="imgChanged">

      <div class="row justify-content-center">
        <div class="col-12 pb-4">
          <div class="card bg-info text-light">
            <div class="card-header">
              @lang($show ? 'Cocktail bewerken' : 'Cocktail toevoegen')
            </div>

            <div class="card-body">
              <div class="row">
                @if($show)
                  <div class="col-3">
                    <img class="img-thumbnail"
                         src="{{ asset($cocktail->imgUrl) }}"
                         alt="@lang('No image')">
                  </div>

                  <div class="col-9">
                    @include('partials.cocktail_edit')
                  </div>
                @else
                  <div class="col">
                    @include('partials.cocktail_edit')
                  </div>
                @endif
              </div>
            </div>

            <div class="card-footer">
              <div class="btn-group">
                <button class="btn btn-primary" type="submit">
                  @if($show)
                    @lang('Opslaan')
                  @else
                    <i class="fas fa-plus"></i> @lang('Toevoegen')
                  @endif
                </button>

                @if($show)
                  <button
                    class="btn btn-danger"
                    type="button"
                    data-toggle="modal"
                    data-target="#destroy">
                    @lang('Verwijderen')
                  </button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 pb-4">
          <div class="card text-white bg-dark">
            <div class="card-header">
              @lang('Dranken')
            </div>

            <ul class="list-group list-group-flush" id="ingredients">
              @if($show)
                @foreach($cocktail->ingredients() as $ingredient)
                  @include('partials.add.ingredient', ['ingredient' => $ingredient])
                @endforeach
              @endif
            </ul>
          </div>
        </div>

        <div class="col-md-6 pb-4">
          <div class="card text-white bg-dark">
            <div class="card-header">
              @lang('Beschikbare dranken')
            </div>

            <ul class="list-group list-group-flush">
              @foreach($ingredients as $ingredient)
                <li
                  class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center"
                  onclick="addIngredient({{ $ingredient->id }})">
                  {{ $ingredient->name }}

                  <span class="badge badge-dark badge-pill">
                    Pump {{ $ingredient->pump_id }} - {{ $ingredient->pump->type }} - {{ $ingredient->pump->pin }}
                  </span>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
