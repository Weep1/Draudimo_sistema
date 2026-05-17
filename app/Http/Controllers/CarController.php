<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Models\CarPhoto;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->isAdmin() || $user->isReadOnly()){
            $cars = Car::all();
        } else {
            $cars = Car::whereHas('owner', function($query) use($user){
                $query->where('user_id', $user->id);
            })->get();
        }
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->isAdmin() || $user->isReadOnly()) {

        $owners = Owner::all();

    } else {

        $owners = Owner::where('user_id', $user->id)->get();
    }
        return view('cars.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reg_number' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'owner_id' => ['nullable', 'exists:owners,id'],
        ]);

        $car = Car::create($data);

        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $photo) {

                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo' => $path
                ]);
            }
        }

        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        $user = auth()->user();
        if ($user->isAdmin() || $user->isReadOnly()) {

            $owners = Owner::all();

        } else {

            $owners = Owner::where('user_id', $user->id)->get();
        }
        return view('cars.edit', compact('car', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $this->authorize('update', $car);
        $data = $request->validate([
            'reg_number' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'owner_id' => ['nullable', 'exists:owners,id'],
        ]);

        $car->update($data);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {

                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo' => $path
                ]);
            }
        }
        //dd($request->all(), $request->file('photos'));
        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $car->delete();
        return redirect()->route('cars.index');
    }
    public function deletePhoto(CarPhoto $photo){
        Storage::disk('public')->delete($photo->photo);
        $photo->delete();
        return redirect()->route('cars.edit', $photo->car_id);
    }
}
