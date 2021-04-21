@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Companies</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Companies</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
@include('partials._alerts')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Companies Table</h3>
        <div class="card-tools">
            <a href="{{ route('companies.create') }}" class="btn btn-block btn-primary">Create</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 100px">Logo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>
                        <img src="{{ $company->present()->logo(50, 50) }}" class="h-auto rounded w-50"
                            alt="{{ $company->name }}">
                    </td>
                    <td>{{ $company->present()->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <div class="flex-row mb-2 d-flex bd-highlight align-items-center justify-content-around">
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST">
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
        {{ $companies->links() }}
    </div>
</div>
@stop
