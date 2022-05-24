@extends('layouts.admin.datatables')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stockholders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right text-capitalize">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt text-sm mr-2"></i>
                                    {{ __('admin.dashboard') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('admin.stockholders') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Stockholder name</th>
                                        <th>Email</th>
                                        <th>Is admin</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($stockholders as $stockholder)
                                    <tr>
                                        <td>{{ $stockholder->name }}</td>
                                        <td>{{ $stockholder->email }}</td>
                                        <td>{{ $stockholder->is_admin }}</td>
                                        <td>{{ $stockholder->status }}</td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Stockholder name</th>
                                        <th>Email</th>
                                        <th>Is admin</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
