@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Employee Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                <li class="breadcrumb-item active">Employee Details</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-solid">
    <div class="pb-0 card-body">
        <div class="col-12">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{ $employee->present()->name }}</b></h2>
                            <ul class="mb-0 ml-4 fa-ul text-muted">
                                <li class="text-md">
                                    <span class="fa-li"><i class="fas fa-envelope"></i></span>
                                    Email: {{ $employee->present()->email }}
                                </li>
                                <li class="text-md">
                                    <span class="fa-li"><i class="fas fa-phone"></i></span>
                                    Website: {{ $employee->present()->phone }}
                                </li>
                                <li class="text-md">
                                    <span class="fa-li"><i class="fas fa-briefcase"></i></span>
                                    Company: {{ $employee->company->present()->name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
