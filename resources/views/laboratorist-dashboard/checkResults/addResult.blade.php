@extends('laboratorist-dashboard.partials.master')
@section('content')
    @push('styles')
        <link href="{{asset('dashboard-assets/css/main.css')}}" rel="stylesheet" type="text/css">
    @endpush
    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Prescriptions</h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->


    @if( count($errors) > 0 )
        @include('doctor-dashboard.partials.error_alert')
    @endif

    <div class="card">
        <!-- begin :: Card body -->
        <div class="card-body p-0">
            <!-- begin :: Form -->
            <form action="{{route('lab-dashboard.addResult',$prescription)}}" class="form" method="POST"
                  enctype="multipart/form-data" id="my-form">
            @csrf
            @method('post')
            <!-- begin :: Card header -->

                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark"> Add Report</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="px-8 py-4">
                    <!-- begin :: Row -->
                    <div class="row mb-8">
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Checks</label>
                            <div class="form-floating">
                                <input type="text" disabled class="form-control"
                                       value="{{ $prescription->checks_names }}">

                            </div>
                            <!-- begin :: Column -->
                            <div class="col-md-12 text-center mb-5 fv-row">

                                <div class="multiple-uploader" id="multiple-uploader">
                                    <div class="mup-msg">
                                        <span class="mup-main-msg">click to upload Checks Results.</span>
                                        <span class="mup-msg" id="max-upload-number"></span>
                                        <span class="mup-msg"></span>
                                    </div>
                                </div>

                            </div>
                            <!-- end   :: Column -->

                            <!-- begin :: Column -->
                            <div class="col-md-6 fv-row">

                                <label class="fs-5 fw-bold mb-2">Checks Report</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name_inp" name="checks_report"
                                           placeholder="example" value="{{ old('name') }}">
                                    <label for="name_inp">Enter Checks Report</label>
                                </div>
                                @error('check_report')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror


                            </div>
                            <!-- end   :: Column -->
                            <!-- begin :: Column -->
                            <div class="col-md-6 fv-row">

                                <label class="fs-5 fw-bold mb-2">Xray Report</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name_inp" name="xray_report"
                                           placeholder="example" value="{{ old('name') }}">
                                    <label for="name_inp">Enter Xray Report</label>

                                </div>
                                @error('xray_report')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <!-- end   :: Column -->

                        </div>
                        <!-- end   :: Row -->  <!-- begin :: Form footer -->
                        <div class="form-footer p-8 text-end">

                            <!-- begin :: Submit btn -->
                            <button type="submit" class="btn btn-primary">

                                <span class="indicator-label">Add Report</span>

                            </button>
                            <!-- end   :: Submit btn -->

                        </div>
                        <!-- end   :: Form footer -->
                    </div>
                </div>
            </form>

            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
@push('scripts')
    <script src="{{asset('dashboard-assets/js/multiple-uploader.js')}}"></script>
    <script>

        let multipleUploader = new MultipleUploader('#multiple-uploader').init({
            maxUpload: 20, // maximum number of uploaded images
            maxSize: 2, // in size in mb
            filesInpName: 'images', // input name sent to backend
            formSelector: '#my-form', // form selector
        });

        multipleUploader.clear(); // this function clears all uploaded images

    </script>
@endpush
