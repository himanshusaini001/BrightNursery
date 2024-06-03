<!DOCTYPE html>
<html lang="en">
<!-- ##### Top Bar Link Start ##### -->
    @include('frontend.include.main_file.topbar_link')
<!-- ##### Top Bar Link End ##### -->
<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-circle"></div>
        <div class="preloader-img">
            <img src="img/core-img/leaf.png" alt="">
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
        @include('frontend.include.main_file.header')
    <!-- ##### Header Area End ##### -->

   
        @yield('content')
   <!-- ##### Footer Area Start ##### -->
        @include('frontend.include.main_file.footer')
   <!-- ##### Footer Area End ##### -->
</body>

</html>