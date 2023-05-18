@extends('doctor-dashboard.partials.master')
@section('content')

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
            <form action="{{route('doctor-dashboard.prescriptions.update',$prescription->id)}}" class="form" method="POST"
                  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- begin :: Card header -->

                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark"> Edit Prescription</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="px-8 py-4">

                    <!-- begin :: Row -->
                    <div class="row mb-8">
                        <div class="col-md-12 text-center mb-5 fv-row">

                            <!-- begin :: Column -->

                            <div class="col-md-6 fv-row" id="children-categories-container">
                                <br>
                                <label class="fs-5 fw-bold mb-2">Patients</label>
                                <select class="form-select" data-control="select2" name="user_id" multiple
                                        data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach($users as $user)
                                        <option
                                            {{$user->id == $prescription->user->id ? 'selected': ''}} value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                                @error('users')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- end   :: Column -->
                            <!-- begin :: Column -->

                            <div class="col-md-6 fv-row" id="children-categories-container">
                                <br>
                                <label class="fs-5 fw-bold mb-2">Medicines</label>
                                <select class="form-select" data-control="select2" name="medicines[]" multiple
                                        data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach($medicines as $medicine)
                                        <option
                                            {{ (in_array($medicine->id,($prescription->medicines_id))) ? 'selected':'' }} value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach

                                </select>
                                @error('medicines')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- end   :: Column -->
                            <!-- begin :: Column -->

                            <div class="col-md-6 fv-row" id="children-categories-container">
                                <br>
                                <label class="fs-5 fw-bold mb-2">Checks</label>
                                <select class="form-select" data-control="select2" name="checks[]" multiple
                                        data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach($checks as $check)
                                        <option
                                            {{ (in_array($check->id,($prescription->checks_id))) ? 'selected':'' }} value="{{ $check->id }}">{{ $check->name }}</option>
                                    @endforeach

                                </select>
                                @error('checks')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- end   :: Column -->

                        </div>
                        <!-- end   :: Row -->
                        <!-- begin :: Row -->


                    </div>
                    <!-- end   :: Inputs wrapper -->

                    <!-- begin :: Form footer -->
                    <div class="form-footer p-8 text-end">

                        <!-- begin :: Submit btn -->
                        <button type="submit" class="btn btn-primary">

                            <span class="indicator-label">save Edit</span>

                        </button>
                        <!-- end   :: Submit btn -->

                    </div>
                    <!-- end   :: Form footer -->
                </div>
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
