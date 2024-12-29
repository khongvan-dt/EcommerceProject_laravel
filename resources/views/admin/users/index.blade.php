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
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Add New</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">User Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3">
                                                <h6>STT</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>First Name</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Last Name</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Avatar</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Email</h6>
                                            </th>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Phone</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Address</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Role</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Status</h6>
                                            </th>
                                            <th class="px-4 py-3">
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <p>{{$loop->iteration}}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->firstName}}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->lastName}}</p>
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/'. $user->avatar) }}" alt="avatar" width="50" height="50">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->email}}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->phone}}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->address}}</p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p>{{$user->role}}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($user->status == 0)
                                                        <span class="status-btn active-btn">Active</span>
                                                    @else
                                                        <span class="status-btn inactive-btn">Inactive</span>
                                                    @endif  
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.users.destroy', $user->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>                                                      
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
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
