@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Edit User</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Edit User
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
                    <div class="col-lg-12">
                        <!-- input style start -->
                        <div class="card-style">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="input-style-1">
                                    <label>First Name</label>
                                    <input type="text" placeholder="First Name" name="firstName" value="{{ old('first_name', $user->first_name) }}" required />
                                    @error('firstName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end input -->
                                <div class="input-style-2">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Last Name" name="lastName" value="{{ old('last_name', $user->last_name) }}" required />
                                    @error('lastName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email" name="email" value="{{ old('email', $user->email) }}" required />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Phone</label>
                                    <input type="number" placeholder="Phone Number" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Address</label>
                                    <input type="text" placeholder="Address" name="address" value="{{ old('address', $user->address) }}" />
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Avatar</label>
                                    <input type="file" name="avatar" />
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 50px; height: 50px; margin-top: 10px;">
                                    @endif
                                    @error('avatar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="select-style-1">
                                    <label>Role</label>
                                    <div class="select-position">
                                        <select name="role">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit" class="main-btn success-btn rounded-full btn-hover">Update</button>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.users.index') }}" class="main-btn danger-btn rounded-full btn-hover">Cancel</a>
                                    </li>
                                </div>
                            </form>
                        </div>
                    </div>
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
