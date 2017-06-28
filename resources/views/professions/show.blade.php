@extends ('layouts.app')

@section ('title', 'Профессии')

@section ('subnavigation')
    @include('professions/partials/_navigation', ['heading' => $profession->title])
@endsection

@section ('head')
  <style>
      .overlay {
          position: fixed; bottom: 30px; left: 22px; z-index: 10;
      }

      .ui.article.container img {
        margin: 15px;
      }
  </style>
@endsection

@section ('content')
    <div class="ui article container">
      @include ('professions/partials/show/_labels')
      @include ('professions/partials/show/_profession_information')
    </div>

    @include ('professions/partials/show/_related')

    <div class="overlay">
      @include ('professions/partials/_options', [
          'menu_direction' => 'left',
      ])
    </div>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
