<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|integer',
            'amount' => 'required|integer',
            'method' => 'required|string'
        ]);

        $payment = Payment::create([
            'rental_id' => $request->rental_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => 'pending'
        ]);

        return response()->json($payment, 201);
    }

    public function show(string $id)
    {
        try {
            return response()->json(Payment::findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $payment->update($request->all());

            return response()->json($payment);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }

    public function destroy(string $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return response()->json(['message' => 'Deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }
}
