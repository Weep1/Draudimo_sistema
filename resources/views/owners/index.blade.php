@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <h2 class="mb-4 text-center">{{__('Owners list')}}</h2>

        <div class="mb-3 text-center flex">
            <a href="{{ route('owners.create') }}" class="btn btn-success">{{__('Add New Owner')}}</a>
        </div>

        @if($owners->isEmpty())
            <div class="alert alert-info text-center">
                No owners found.
            </div>
        @else
            <div class="table-responsive shadow rounded">
                <table class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Surname')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__("Email")}}</th>
                        <th>{{__("Address")}}</th>
                        @if(!auth()->user()->isReadOnly())
                            <th>{{__('Actions')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($owners as $owner)
                        <tr>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->surname }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->address }}</td>
                            @if(!auth()->user()->isReadOnly())
                                <td>
                                    <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                    <a href="{{ route('owners.destroy', $owner->id) }}" class="btn btn-danger">{{__('Delete')}}</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
