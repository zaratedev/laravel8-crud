<ul>
    <li>{{ $employee->present()->name }}</li>
    <li>{{ $employee->email }}</li>
    <li>{{ $employee->phone }}</li>
    <li>{{ $employee->company->present()->name }}</li>
</ul>