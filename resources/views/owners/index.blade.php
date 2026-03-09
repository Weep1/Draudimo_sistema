@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <h2 class="mb-4 text-center">Car Owners</h2>

        <div class="mb-3 text-center flex">
            <a href="{{ route('owners.create') }}" class="btn btn-success">Add New Owner</a>
        </div>

        @if($owners->isEmpty())
            <div class="alert alert-info text-center">
                No owners found.
            </div>
        @else
            <div class="table-responsive shadow rounded">
                <table class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($owners as $owner)
                        <tr>
                            <td>{{ $owner->id }}</td>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->surname }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->address }}</td>
                            <td>
                                <a href="{{ route('owners.edit', $owner) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
