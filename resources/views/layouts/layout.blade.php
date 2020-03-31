@include('layouts.partials._head')

<header>
  @yield('header')
</header>

<main class="d-flex justify-content-around flex-wrap">
  @yield('main-content')
</main>

<section class="d-flex justify-content-around flex-wrap">
  @yield('section-content')
</section>

<section>
  @yield('form')
</section>

<footer class="text-center">
  @yield('footer')
</footer>

@include('layouts.partials._footer')
  
