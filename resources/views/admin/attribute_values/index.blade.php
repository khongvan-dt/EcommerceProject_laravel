@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Attribute Values</h2>
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
                                        Attribute Values
                                    </li>
                                </ol>
                                <a href="{{ route('admin.attributeValues.create', $attributeId) }}"
                                    class="btn btn-primary float-right">Add New</a>
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
                            <h6 class="mb-10">Attribute Values Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Attribute Name</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Stock</h6>
                                            </th>
                                            <th>
                                                <h6>Price In</h6>
                                            </th>
                                            <th>
                                                <h6>Price Out</h6>
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
                                        @foreach ($attributeValues as $attr)
                                            <tr>
                                                <td>
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $attr->attribute->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $attr->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $attr->stock }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ number_format($attr->priceIn * 1000, 0, ',', '.') }} đ</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ number_format($attr->priceOut * 1000, 0, ',', '.') }} đ</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($attr->status == 0)
                                                        <span class="status-btn active-btn">Active</span>
                                                    @else
                                                        <span class="status-btn inactive-btn">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.attributeValues.destroy', ['id' => $attr->id, 'attributeId' => $attributeId]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this attribute value?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.attributeValues.edit', ['id' => $attr->id, 'attributeId' => $attributeId]) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- More rows would be added dynamically here -->
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
