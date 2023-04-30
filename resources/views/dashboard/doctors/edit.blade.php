@extends('dashboard.partials.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Doctors</h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->


    @if( count($errors) > 0 )
        @include('dashboard.partials.error_alert')
    @endif

    <div class="card">
        <!-- begin :: Card body -->
        <div class="card-body p-0">
            <!-- begin :: Form -->
            <form action="{{ route('dashboard.doctors.update',$doctor->id) }}" class="form" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->

                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark"> Edit Doctor</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="px-8 py-4">


                    <!-- begin :: Row -->
                    <div class="row mb-8">
                        <div class="col-md-12 text-center mb-5 fv-row">

                            <!--begin::Image input-->
                            <div class="image-input image-input-empty"
                                 style="background-image: url('{{ asset('storage/images/doctors/' . $doctor['image']) }}')">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-125px h-125px"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="avatar_remove"/>
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                            </div>
                            <!--end::Image input-->


                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Name</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') ?? $doctor->name }}">

                            </div>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Email</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="email"
                                       value="{{ old('email') ?? $doctor->email }}"/>

                            </div>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>
                        <div class="col-md-6 fv-row">
                            <br>
                            <label class="fs-5 fw-bold mb-2">Phone</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="phone"
                                       value="{{ old('phone') ?? $doctor->phone }}"/>

                            </div>
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>
                        <div class="col-md-6 fv-row">
                            <br>
                            <label class="fs-5 fw-bold mb-2">Price</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="price"
                                       value="{{ old('price') ?? $doctor->price }}">

                            </div>
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>
                        <div class="col-md-6 fv-row">
                            <br>
                            <label class="fs-5 fw-bold mb-2">Description</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="description"
                                       value="{{ old('description') ?? $doctor->description }}">

                            </div>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>
                        <div class="col-md-6 fv-row" id="children-categories-container" >

                            <label class="fs-5 fw-bold mb-2">Department</label>
                            <select class="form-select" data-control="select2"  name="department_id" multiple data-placeholder="{{old('department') ?? $doctor->department->name}}">
                                <option value=""> </option>
                                @foreach($departments as $department)
                                    <option {{$doctor->department_id == $department->id? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach

                            </select>
                            @error('departments')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- end   :: Column -->

                        <!-- begin :: Column -->


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
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
