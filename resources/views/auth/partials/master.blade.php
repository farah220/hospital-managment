<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('auth.partials.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image:url({{asset('dashboard-assets/media/illustrations/development-hd.png')}})">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->

                                <img alt="Logo"  src="{{ asset('dashboard-assets/media/logos/cloud.ico') }}" class="h-45px"  />
        @yield('content')
        <!--end::Logo-->
        </div>
        <!--end::Content-->
        @include('auth.partials.footer')
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
@include('auth.partials.foot')
</body>
<!--end::Body-->
</html>
