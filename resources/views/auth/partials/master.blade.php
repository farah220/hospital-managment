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
            <a href="" class="mb-12" >
                                <img alt="Logo" style="width:80px;height: 80px;" src="{{ asset('dashboard-assets/WhatsApp Image 2023-05-20 at 12.53.37 AM.jpeg') }}" class="h-45px" />
            </a>
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
