@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-3">
            <h2>{{__('Cars')}}</h2>
            <a href="{{ route('cars.create') }}" class="btn btn-success">{{__('Add')}}</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th style="width:300px;"></th>
                <th>{{__('Number')}}</th>
                <th>{{__('Brand')}}</th>
                <th>{{__('Model')}}</th>
                <th>{{__('Owner')}}</th>
                @if(!auth()->user()->isReadOnly())
                    <th>{{__('Actions')}}</th>
                @endif

            </tr>
            </thead>

            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>
                        @if ($car->photos->isNotEmpty() )
                            @foreach($car->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->photo) }}" alt="" width="49%" class="">
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $car->reg_number }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>
                        @if($car->owner)
                            {{ $car->owner->name }} {{ $car->owner->surname }}
                        @else
                            <span class="text-muted">{{__('Not added')}}</span>
                        @endif
                    </td>
                    <td >
                        @if(!auth()->user()->isReadOnly())
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning mb-1">{{__('Alter')}}</a>

                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline" onsubmit="return confirm('Tikrai ištrinti?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mb-1">{{__('Delete')}}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
