@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add New Car</h3>
            </div>
            <div class="card-body">

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('cars.store') }}">
                    @csrf

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="reg_number" name="reg_number"
                               placeholder="Registration Number" value="{{ old('reg_number') }}" required>
                        <label for="reg_number">Registration Number</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="brand" name="brand"
                               placeholder="Brand" value="{{ old('brand') }}" required>
                        <label for="brand">Brand</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="model" name="model"
                               placeholder="Model" value="{{ old('model') }}" required>
                        <label for="model">Model</label>
                    </div>

                    <div class="mb-3">
                        <label for="owner_id" class="form-label">Owner</label>
                        <select name="owner_id" id="owner_id" class="form-select">
                            <option value="">-- Unassigned --</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                                    {{ $owner->name }} {{ $owner->surname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save Car</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
