@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>{{__('Edit car')}} #{{ $car->id }}:</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cars.update', $car) }}" class="mt-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">{{__('Registration number')}}</label>
                <input class="form-control" name="reg_number" value="{{ old('reg_number', $car->reg_number) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{__('Brand')}}</label>
                <input class="form-control" name="brand" value="{{ old('brand', $car->brand) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{__('Model')}}</label>
                <input class="form-control" name="model" value="{{ old('model', $car->model) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{__("Owner")}}</label>
                <select name="owner_id" class="form-select">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('owner_id', $car->owner_id) == $owner->id)>
                            {{ $owner->name }} {{ $owner->surname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{__('Add Photo: ')}}</label>
                <input type="file" class="form-control" name="photos[]" multiple>
            </div>
            <hr>
            @if($car->photos->isNotEmpty())
                @foreach($car->photos as $photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $photo->photo) }}"
                             width="150"
                             class="img-thumbnail">
                        <br>
                        <a class="btn btn-danger mt-2"
                           href="{{ route('cars.deletePhoto', $photo) }}">
                            Ištrinti nuotrauką
                        </a>
                    </div>
                @endforeach
            @endif
            <button class="btn btn-primary">{{__('Save Changes')}}</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{__('Back')}}</a>
        </form>
    </div>
@endsection
