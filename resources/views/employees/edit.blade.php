@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Employee Edit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                <li class="breadcrumb-item active">Employee Edit</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<form action="{{ route('employees.update', $employee) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter ..."
                                    value="{{ old('first_name', $employee->first_name) }}">
                                @error('first_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter ..."
                                    value="{{ old('last_name', $employee->last_name) }}">
                                @error('last_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Enter company email" value="{{ old('email', $employee->email) }}">
                        @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter ..." value="{{ old('phone', $employee->phone) }}">
                                @error('phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <select id="company" name="company_id" class="form-control custom-select">
                                    <option value="" disabled="">Select one</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id', $company->id) == $employee->company_id ? 'selected' : '' }}>
                                        {{ $company->present()->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="pb-4 row">
        <div class="col-12">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Save Changes" class="float-right btn btn-success">
        </div>
    </div>
</form>
@stop
