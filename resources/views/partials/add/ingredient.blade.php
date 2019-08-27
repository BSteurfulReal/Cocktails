<li
  class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
  <div class="input-group">
    @php($id = mt_rand())

    <div class="input-group-prepend">
      <label for="{{ $id }}" class="input-group-text rounded-0">
        {{ $ingredient->name }}
      </label>
    </div>

    <input type="hidden" name="ingredients[]" value="{{ $ingredient->id }}">

    <input
      class="form-control"
      id="{{ $id }}"
      type="number"
      @if(isset($show) && $show) value="{{ $ingredient->coupling_percentage }}" @endif
      placeholder="@lang('percentage')"
      name="percentages[]"/>

    <div class="input-group-append">
      <button class="btn btn-danger rounded-0" type="button" onclick="removeIngredient(this)">
        <i class="fas fa-trash"></i>
      </button>
    </div>
  </div>
</li>
