@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Users Management</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Users
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <form method="POST" action="{{route('admin.users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <!-- First Name -->
                                <div class="input-style-1">
                                    <label>First Name</label>
                                    <input type="text" placeholder="First Name" name="firstName"
                                        value="{{ old('firstName') }}" required />
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="input-style-2">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Last Name" name="lastName"
                                        value="{{ old('lastName') }}" required />
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="input-style-2">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"
                                        required />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password</label>
                                        <input type="password" placeholder="Password" name="password" required />
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Confirm Password</label>
                                        <input type="password" placeholder="Confirm Password" name="confirmPassword"
                                            required />
                                        @error('confirmPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="input-style-2">
                                    <label>Phone</label>
                                    <input type="number" placeholder="Phone Number" name="phone"
                                        value="{{ old('phone') }}" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="input-style-2">
                                    <label>Address</label>
                                    <input type="text" placeholder="Address" name="address"
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Avatar -->
                                <div class="input-style-2">
                                    <label>Avatar</label>
                                    <input type="file" name="avatar" />
                                    @error('avatar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="select-style-1">
                                    <label>Role</label>
                                    <div class="select-position">
                                        <select name="role">
                                            <option value="">Select Role</option>
                                            <option value="ADMIN" {{ old('role') == 'ADMIN' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="USER" {{ old('role') == 'USER' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
                                    </div>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit"
                                            class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>

                                    <li>
                                        <button type="reset"
                                            class="main-btn danger-btn rounded-full btn-hover">Reset</button>
                                    </li>
                                </div>
                                <!-- end input -->
                            </div>
                        </div>
                    </form>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
