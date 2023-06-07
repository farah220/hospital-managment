@extends('auth.partials.master')

@section('content')

    <!--begin::Wrapper-->
    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

        <!--begin::Form-->
        <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('admins.login') }}">
        @csrf
        <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">Sign In to Cloud Care</h1>
                <!--end::Title-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                       value="{{ old('email') }}" autocomplete="off"/>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack mb-2">
                    <!--begin::Label-->
                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                    <!--end::Label-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                       autocomplete="off"/>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <!--begin::Submit button-->
                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                    <span class="indicator-label">Continue</span>

                </button>
                <!--end::Submit button-->

            </div>

            <!--end::Actions-->
        </form>
        <!--end::Form-->
        <div class=" p-8 text-center">

            <a class="btn btn-primary" href="{{ route('main') }}">
                Back To Main Page
            </a>

        </div>

    </div>
    <!--end::Wrapper-->

@endsection

