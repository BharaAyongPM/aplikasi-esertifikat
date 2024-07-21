<!DOCTYPE html>
<html lang="en">
@include('admin/dashboard/head')

<body>
    @include('layouts/topbar')
    <div class="container-scroller">

        @yield('content')

      </div>
    @include('admin/dashboard/footer')
    @include('admin/dashboard/js')
</body>
</html>
