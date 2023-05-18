@extends('dashboard.partials.master')

@section('content')

    @if( session()->has('success_message') )
        @include('dashboard.partials.success_alert')
    @endif
    <!--begin::Card-->
    <div class="card m-10">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                    <!--begin::Add customer-->
                    <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Plus.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.5"
                                      transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                      x="4" y="11" width="16" height="2" rx="1"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Add Admin
                    </a>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table text-center align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Email</th>
                    <th class="min-w-125px">phone</th>
                    <th class="min-w-125px">Created At</th>
                    <th class="min-w-70px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                @forelse($admins as $admin)
                    <tr>
                        <!--begin::Name=-->
                        <td>
                            {{$admin->name}}
                        </td>
                        <!--end::Name=-->
                        <!--begin::Email=-->
                        <td>
                            {{$admin->email}}
                        </td>
                        <!--end::Email=-->
                        <!--begin::Phone=-->
                        <td>
                            {{$admin->phone}}
                        </td>
                        <!--end::Phone=-->
                        <!--begin::Date=-->
                        <td>{{ date("m-d-Y" , strtotime($admin->created_at)) }}</td>
                        <!--end::Date=-->
                        <!--begin::Action=-->
                        <td>
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                               data-kt-menu-flip="top-end">Actions
                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"/>
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('dashboard.admins.show',$admin) }}"
                                       class="menu-link px-3">View</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('dashboard.admins.edit',$admin) }}"
                                       class="menu-link px-3">Edit</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <form method="POST" action="{{ route('dashboard.admins.destroy',$admin) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" btn menu-link px-5" type="submit">Delete</button>
                                    </form>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <h4 class="text-muted text-center my-4"> No Data Available</h4>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
            {{$admins->links()}}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

@endsection

