<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $items = Item::all();

            return response()->json([
                'success' => true,
                'message' => 'Data inventory berhasil diambil',
                'data' => $items
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data inventory',
                'error' => $e->getMessage()
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
                'item_name' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'stock' => 'required|integer|min:0',
                'price_per_day' => 'required|numeric|min:0',
                'status' => 'required|string'
            ]);

            $item = Item::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil ditambahkan',
                'data' => $item
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $item = Item::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data item ditemukan',
                'data' => $item
            ], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $item = Item::findOrFail($id);

            $request->validate([
                'item_name' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'stock' => 'required|integer|min:0',
                'price_per_day' => 'required|numeric|min:0',
                'status' => 'required|string'
            ]);

            $item->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil diupdate',
                'data' => $item
            ], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate item'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $item = Item::findOrFail($id);

            $item->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item'
            ], 500);
        }
    }
}
