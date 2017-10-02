<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>

  <body>

    @include('partials._nav')
      
    <!-- Build the main body -->
    <div class="container">
      @include('partials._messages')
       
      {{ Auth::check() ? "Logged In ". Auth::user()->name : "Logged Out" }}﻿ 

      @yield('content')

      @include('partials._footer')

    </div> <!-- end of .container -->

        @include('partials._javascript')

        @yield('scripts')
    </body>
</html>