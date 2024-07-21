<!DOCTYPE html>
<html lang="en">
    @include('admin/dashboard/head')

<body>
    @include('admin/dashboard/topbar')
  <div class="container-scroller">


    @include('admin/dashboard/sidebar')
      <!-- partial -->
      @yield('content')
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
</div>
@include('admin/dashboard/footer')
<!-- container-scroller -->

<!-- plugins:js -->
{{-- javascript --}}
@include('admin/dashboard/js')

</body>

</html>

