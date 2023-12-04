@include('admin.layouts.header')

  <div id="wrapper">
 
    <!-- Sidebar -->

    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
@include('admin.layouts.navbar2')

        <!-- Topbar -->

        <!-- Container Fluid-->
@yield('content')
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
@include('admin.layouts.Footer')
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>