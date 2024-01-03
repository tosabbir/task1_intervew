@extends('master')
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard"
                                            role="tab" aria-controls="dashboard" aria-selected="false"><i
                                                class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"><i
                                                class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">


                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello {{ $userData->name }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a
                                                    href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a
                                                    href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">

                                            <form method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input class="form-control"
                                                            name="name" type="text"
                                                            value="{{ $userData->name }}" readonly/>

                                                        <input class="form-control" name="id" type="hidden"
                                                            value="{{ $userData->id }}" />

                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input class="form-control"
                                                            name="email" type="email" value="{{ $userData->email }}"
                                                            value="{{ $userData->email }}" readonly/>

                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="settings" role="tabpanel"
                                    aria-labelledby="settings-tab">
                                    <div class="card">
                                        <div class="card-header fs-5">
                                            <h4>Settings</h4>
                                        </div>
                                        <div class="card-body">
                                            <card-title>
                                                <h6>Change Password</h6>
                                            </card-title>
                                            <form action="{{ route('password.update') }}" method="post">
                                                @csrf
                                                <div class="card-body">
                                                    @if (Session::has('error'))
                                                        <div class="alert alert-danger" role="alert" >
                                                            {{Session::get('error')}}
                                                        </div>
                                                    @endif

                                                    {{-- old password  --}}
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3 flex">
                                                            <p class="mb-0">Old Password:</p>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password"
                                                                class="form-control @error('old_password') is-invalid @enderror"
                                                                id="old_password" name="old_password" />

                                                            @error('old_password')
                                                                <span class="text-danger"></span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- new password  --}}
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3 flex">
                                                            <p class="mb-0">New Password:</p>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password"
                                                                class="form-control @error('new_password') is-invalid @enderror"
                                                                id="new_password" name="new_password" />

                                                            @error('new_password')
                                                                <span class="text-danger"></span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- confirm password  --}}
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3 flex">
                                                            <p class="mb-0">Confirm Password:</p>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password"
                                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                                id="confirm_password" name="confirm_password" />

                                                            @error('confirm_password')
                                                                <span class="text-danger"></span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 mt-3">

                                                        <button type="reset" class="btn btn-info btn-sm">Reset</button>
                                                        <button type="submit" class="btn btn-success btn-sm">save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
