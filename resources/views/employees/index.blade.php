@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Employees</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Employees</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
@include('partials._alerts')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employees Table</h3>
        <div class="card-tools">
          <a href="{{ route('employees.create') }}" class="btn btn-block btn-primary">Create</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->present()->name }}</td>
                    <td>{{ $employee->company->present()->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                        <div class="flex-row mb-2 d-flex bd-highlight align-items-center justify-content-around">
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="clearfix card-footer">
        {{ $employees->links() }}
    </div>
</div>
@stop
