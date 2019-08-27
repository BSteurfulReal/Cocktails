@extends('layouts.app')

@section('scripts')
  <script>
    function serve() {
      let btn = $("#btnServe");
      btn.attr("disabled", true);

      $.post('{{ route ( 'cocktail.serve', $cocktail->id ) }}', {
        '_token': $('meta[name=csrf-token]').attr('content')
      })
        .done((data) => {
        })
        .fail(console.log)
        .always(() => btn.attr('disabled', false));
    }
  </script>
@endsection

@section('page')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-dark text-light">
          <div class="card-header">
            {{ $cocktail->name }}
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <img src="{{ $cocktail->imgUrl }}"
                     class="img-fluid"
                     alt="@lang('Showcase Image')">
              </div>

              <div class="col-9">
                Inhoud is 200 milliliter.
                <br>

                Ingrediënten
                <ul>
                  @foreach($cocktail->ingredients() as $ingredient)
                    <li>{{ $ingredient->name }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button
              class="btn btn-success"
              id="btnServe"
              onclick="serve()"
              type="button">
              @lang('Bereid')
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
