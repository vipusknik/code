<div class="ui purple label">ID:  {{ $model->id }}</div>

@if ($model->is_paid)
  <div class="ui orange label">
    <i class="star icon"></i> Платник
  </div>
@endif

<a class="ui basic label{{ $model->markedByCurrentUser ? ' marked' : '' }}"
   id="marker"
   onclick="event.preventDefault(); toggleMark('{{ class_basename($model) }}', '{{ $model->id }}');"
   title="Оставляйте отметки чтобы вернуться к ним позже. Ваши отметки видны только Вам.">
  @if ($model->markedByCurrentUser)
    Отмечено Вами
  @else
    Отметить для себя
  @endif
</a>

@if ($model->pin)
  <a href="#" class="ui olive label" onmouseover="showPin()" onmouseout="hidePin()" id="pin-label">
    Показать пин
  </a>
@endif