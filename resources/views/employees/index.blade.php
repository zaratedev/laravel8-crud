@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<h1>Employees</h1>
@stop
@section('content')
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
                    <td>Acciones</td>
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
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $employees->links() }}
    </div>
</div>
@stop
