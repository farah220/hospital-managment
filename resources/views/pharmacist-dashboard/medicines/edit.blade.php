@extends('pharmacist-dashboard.partials.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Medicines</h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->


    @if( count($errors) > 0 )
        @include('pharmacist-dashboard.partials.error_alert')
    @endif

    <div class="card">
        <!-- begin :: Card body -->
        <div class="card-body p-0">
            <!-- begin :: Form -->
            <form action="{{ route('dashboard.medicines.update',$medicine->id) }}" class="form" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->

                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark"> Edit Medicine</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="px-8 py-4">


                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Name</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') ?? $medicine->name }}">

                            </div>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>

                        <div class="col-md-6 fv-row">
                            <br>
                            <label class="fs-5 fw-bold mb-2">Price</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="price"
                                       value="{{ old('price') ?? $medicine->price }}">

                            </div>
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>

                        <!-- end   :: Column -->

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
                </div>
            </form>

            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
