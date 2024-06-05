<!DOCTYPE html>
<html lang="en">

<head>
  {{-- head link Start --}}
      @include('admin.include.head_link')
  {{-- head link End--}}
  <style>
    .custom-form {
      background-color: white;
      border: 2px solid black;
      padding: 30px 30px 70px 30px;
      border-radius: 8px;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">
  
  {{-- Side bar Start--}}
  @include('admin.include.sidebar')
  {{-- Side bar End--}}

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
      {{-- Header Start--}}
        @include('admin.include.header')
      {{-- Header End--}}
    <!-- End Navbar -->

    <!-- middle Contant Start -->
    <div class="container-fluid py-4">
          @yield('data')
          @yield('form')
        </div>
    <!-- middle Contant End -->

      {{-- Footer Start--}}
       @include('admin.include.footer')
      {{-- Footer End--}}

    </div>
  </main>

  <!--   fixed Plugin Start   -->
    @include('admin.include.fixedPlugin')
  <!--   fixed Plugin End   -->

  <!--   Core JS Files Start   -->
    @include('admin.include.script_link')
  <!--   Core JS Files End   -->
</body>

</html>
