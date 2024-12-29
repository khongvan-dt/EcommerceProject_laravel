@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Blogs</h2>
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
                                        Blogs
                                    </li>
                                </ol>
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary float-right">Add New</a>
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
                            <h6 class="mb-10">Blogs Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Title</h6>
                                            </th>
                                            <th>
                                                <h6>Slug</h6>
                                            </th>
                                            <th>
                                                <h6>Image</h6>
                                            </th>
                                            <th>
                                                <h6>Status</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>
                                                    <p>{{$loop->iteration}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$blog->title}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$blog->slug}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <div class="employee-image">
                                                        <img src="{{ asset('storage/' . $blog->image)}}" alt="Blog Image" style="width: 50px; height: auto;" />
                                                    </div>
                                                </td>
                                                <td class="min-width">
                                                    <span class="status-btn active-btn">Active</span>
                                                </td>
                                                <td class="min-width">
                                                    @if ($blog->status == 0)
                                                        <span class="status-btn active-btn">Unpublish</span>
                                                    @elseif ($blog->status == 1)
                                                        <span class="status-btn inactive-btn">Publish</span>
                                                    @else
                                                        <span class="status-btn inactive-btn"> unsubscribe</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.blogs.destroy', $blog->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this blog?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
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
