@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Review Blogs</h2>
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
                                        Reviews
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Blog Reviews Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Product ID</h6>
                                            </th>
                                            <th>
                                                <h6>User ID</h6>
                                            </th>
                                            <th>
                                                <h6>Rating</h6>
                                            </th>
                                            <th>
                                                <h6>Comment</h6>
                                            </th>
                                            <th>
                                                <h6>Status</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>1</p>
                                            </td>
                                            <td>
                                                <p>101</p>
                                            </td>
                                            <td>
                                                <p>2001</p>
                                            </td>
                                            <td>
                                                <p>5</p>
                                            </td>
                                            <td>
                                                <p>This blog is very informative!</p>
                                            </td>
                                            <td>
                                                <span class="status-btn active-btn">Approved</span>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="text-danger">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>2</p>
                                            </td>
                                            <td>
                                                <p>102</p>
                                            </td>
                                            <td>
                                                <p>2002</p>
                                            </td>
                                            <td>
                                                <p>4</p>
                                            </td>
                                            <td>
                                                <p>Great post, but could use more examples.</p>
                                            </td>
                                            <td>
                                                <span class="status-btn inactive-btn">Pending</span>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="text-danger">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
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
