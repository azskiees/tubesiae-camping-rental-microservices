<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         try {

        $rentals = Rental::all();

        return response()->json([
            'success' => true,
            'message' => 'Data rental berhasil diambil',
            'data' => $rentals
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data rental'
        ], 500);

    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

        $request->validate([
            'customer_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after:rental_date'
        ]);

        $rental = Rental::create([
            'customer_id' => $request->customer_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'rental_date' => $request->rental_date,
            'return_date' => $request->return_date,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rental berhasil dibuat',
            'data' => $rental
        ], 201);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Gagal membuat rental'
        ], 500);

    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         try {

        $rental = Rental::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data rental ditemukan',
            'data' => $rental
        ]);

    } catch (ModelNotFoundException $e) {

        return response()->json([
            'success' => false,
            'message' => 'Rental tidak ditemukan'
        ], 404);

    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

        $rental = Rental::findOrFail($id);

        $rental->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Rental berhasil diupdate',
            'data' => $rental
        ]);

    } catch (ModelNotFoundException $e) {

        return response()->json([
            'success' => false,
            'message' => 'Rental tidak ditemukan'
        ], 404);

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {

        $rental = Rental::findOrFail($id);

        $rental->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rental berhasil dihapus'
        ]);

    } catch (ModelNotFoundException $e) {

        return response()->json([
            'success' => false,
            'message' => 'Rental tidak ditemukan'
        ], 404);

    }
    }
}
