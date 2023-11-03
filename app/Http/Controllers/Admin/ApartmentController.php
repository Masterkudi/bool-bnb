<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();

        // indirizza i nostri dati alla view index 
        return view("admin.apartments.index", ["apartments" => $apartments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newApartment= new Apartment();

        $newApartment->name = $data['name'];
            $newApartment->address = $data['address'];
            $newApartment->description = $data['description'];
            $newApartment->room = $data['room'];
            $newApartment->bed = $data['bed'];
            $newApartment->bathroom = $data['bathroom'];
            $newApartment->mq = $data['mq'];
            $newApartment->latitude = $data['latitude'];
            $newApartment->longitude = $data['longitude'];
            $newApartment->visibility = $data['visibility'];
            $newApartment->availability = $data['availability'];

       
        
        $newApartment->save();

       
        return redirect()->route("admin.apartments.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        return view("admin.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartments = Apartment::findOrFail($id);
        return view('admin.apartments.edit',  ['apartments' => $apartments]);


        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $data = $request->all();
        $apartment->update($data);
        return redirect()->route("admin.apartments.show", $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return redirect()->route('admin.apartments.index')
            ->with('success', 'Appartamento eliminato con successo!');
    }
}
