@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">{{$owner->name.' '.$owner->surname.' id: #'.$owner->id}}</h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('owners.update', $owner) }}">
                    @csrf

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Name" value="{{ old('name', $owner->name) }}" required>
                        <label for="name">First Name</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="surname" name="surname"
                               placeholder="Surname" value="{{ old('surname', $owner->surname) }}" required>
                        <label for="surname">Surname</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="tel" class="form-control" id="phone" name="phone"
                               placeholder="Phone Number" value="{{ old('phone', $owner->phone) }}" required>
                        <label for="phone">Phone Number</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Email" value="{{ old('email', $owner->email) }}" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Address" value="{{ old('address', $owner->address) }}" required>
                        <label for="address">Address</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cars</label>
                        @forelse($cars as $car)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="cars[]" value="{{ $car->id }}" id="car{{ $car->id }}"
                                    {{ in_array($car->id, old('cars', $selectedCars)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="car{{ $car->id }}">
                                    {{ $car->brand }} {{ $car->model }} ({{ $car->reg_number }})
                                </label>
                            </div>
                        @empty
                            <div class="text-muted">No cars available</div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('owners.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save Owner</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
