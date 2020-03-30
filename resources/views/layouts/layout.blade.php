@include('layouts.partials._head')

<header>
  @yield('header')
</header>

<main class="d-flex justify-content-around flex-wrap">
  @yield('main-content')
</main>

<footer>
  @yield('footer')
</footer>

@include('layouts.partials._footer')
  
