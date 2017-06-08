<div class="ui medium menu" style="display: flex !important; margin-bottom: 40px;">
<!--top fixed -->
<div class="ui container">
  <a href="{{ route('home') }}" class="item">
    <img src="/images/logo.png" alt="Главная" class="logo">
  </a>


  <a href="{{ route('universities') }}" class="item">Университеты </a>
  <a href="{{ route('colleges') }}" class="item">Колледжи </a>

  <div class="ui dropdown item">
    Специальности <i class="dropdown icon"></i>
    <div class="menu" style="font-size: 14px;">
        <a href="{{ route('specialties', ['inst' => 0]) }}" class="item">
          <p>Колледжей</p>
        </a>
        <a href="{{ route('specialties', ['inst' => 1]) }}" class="item">
          Универстетов
        </a>
    </div>
  </div>

  <a href="{{ route('professions') }}" class="item">Профессии </a>
  <a href="{{ route('articles') }}" class="item">Статьи </a>

  <a href="{{ route('advertisements.index') }}" class="item">Реклама </a>

  {{-- <div class="ui dropdown item">
    Предметы <i class="dropdown icon"></i>
    <div class="menu" style="font-size: 14px;">
        <a href="{{ route('subjects') }}" class="item">Предметы </a>
        <a href="{{ route('quizzes') }}" class="item">Тесты </a>
    </div>
  </div> --}}

  {{-- <div class="ui search universities item">
    <form action="{{ route('universities.search') }}" method="GET" class="ui form">
      <div class="ui icon input" style="width:250px;">
          <input type="text" placeholder="Университет..." class="prompt" autocomplete="off" name="query">
          <i class="search link icon"></i>
      </div>
    </form>
  </div> --}}

  <div class="right menu">

    @if (Auth::check())

      <div class="ui floating dropdown link item">
        <div class="text">
          <img class="logo" src="{{ auth()->user()->identicon }}">
          {{ auth()->user()->nameOrUsername }}
        </div>
        <i class="dropdown icon"></i>

        <div class="menu">

          <a href="{{ url('profile') }}" class="item">
             <i class="teal user icon"></i> Мой профиль
          </a>

          <a href="{{ route('logout') }}" class="item">
            <i class="teal sign out icon"></i> Выход
          </a>

        </div>
      </div>


    @else
      <a href="{{ route('login') }}" class="item">Вход</a>
      <a href="{{ route('register') }}" class="item">Регистрация</a>
    @endif

  </div>
</div>
</div>
