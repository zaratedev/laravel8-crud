@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<h1>Companies</h1>
@stop
@section('content')
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
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>
                        <img src="{{ $company->present()->logo(50, 50) }}" class="rounded mx-auto d-block" alt="{{ $company->name }}">
                    </td>
                    <td>{{ $company->present()->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $companies->links() }}
    </div>
</div>
@stop
