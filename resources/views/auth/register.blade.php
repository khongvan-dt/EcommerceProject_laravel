@extends('layouts.auth')

@section('content')
    <section class="signin-section">
        <div class="container-fluid">
            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="text-primary mb-10">Get Started</h1>
                                <p class="text-medium">
                                    Start creating the best possible user experience
                                    <br class="d-sm-block" />
                                    for you customers.
                                </p>
                            </div>
                            <div class="cover-image">
                                <img src="{{ asset('assets/admin/images/auth/signin-image.svg') }}" alt="" />
                            </div>
                            <div class="shape-image">
                                <img src="{{ asset('assets/admin/images/auth/shape.svg') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signup-wrapper">
                        <div class="form-wrapper">
                            <h6 class="mb-15">Sign Up Form</h6>
                            <p class="text-sm mb-25">
                                Start creating the best possible user experience for you
                                customers.
                            </p>
                            <form method="POST" action="{{ route('checkRegister') }}">
                                @csrf
                                <!-- Hiển thị lỗi toàn cục từ session -->
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Hiển thị lỗi validation -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email" name="email"
                                                value="{{ old('email') }}" required />
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
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
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="form-check checkbox-style mb-30">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="checkbox-not-robot" required />
                                            <label class="form-check-label" for="checkbox-not-robot">
                                                I'm not a robot</label>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                                Sign Up
                                            </button>
                                            <div class="button-group d-flex justify-content-center flex-wrap">
                                                <a href="{{route('dashboard')}}" class="main-btn success-btn btn-hover mt-3 w-20 text-center">
                                                    Back Home
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                            <div class="singup-option pt-40">
                                <p class="text-sm text-medium text-center text-gray">
                                    Easy Sign Up With
                                </p>
                                <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn-outline m-2">
                                        <i class="lni lni-facebook-fill mr-10"></i>
                                        Facebook
                                    </button>
                                    <button class="main-btn danger-btn-outline m-2">
                                        <i class="lni lni-google mr-10"></i>
                                        Google
                                    </button>
                                </div>
                                <p class="text-sm text-medium text-dark text-center">
                                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </section>
@endsection
