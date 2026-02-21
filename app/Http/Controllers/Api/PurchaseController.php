<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Models\Offer;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function store(PurchaseRequest $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'No autenticado'
            ], 401);
        }

        if ($user->role !== 'client') {
            return response()->json([
                'message' => 'No autorizado'
            ], 403);
        }

        if (!$user->client) {
            return response()->json([
                'message' => 'El usuario no tiene cliente asociado'
            ], 400);
        }

        $offer = Offer::with('company')->find($request->offer_id);

        if (!$offer) {
            return response()->json([
                'message' => 'Oferta no encontrada'
            ], 404);
        }

        if ($offer->status !== 'approved') {
            return response()->json([
                'message' => 'Oferta no disponible'
            ], 400);
        }

        if (now() < $offer->start_date || now() > $offer->end_date) {
            return response()->json([
                'message' => 'Oferta fuera de vigencia'
            ], 400);
        }

        if ($offer->coupon_limit) {
            $totalCoupons = Coupon::where('offer_id', $offer->id)->count();

            if ($totalCoupons + $request->quantity > $offer->coupon_limit) {
                return response()->json([
                    'message' => 'No hay suficientes cupones disponibles'
                ], 400);
            }
        }

        DB::beginTransaction();

        try {
            $client = $user->client;

            $purchase = Purchase::create([
                'client_id' => $client->id,
                'total_amount' => $offer->offer_price * $request->quantity
            ]);

            for ($i = 0; $i < $request->quantity; $i++) {
                $companyCode = $offer->company->code ?? 'DEF001';

                Coupon::create([
                    'offer_id' => $offer->id,
                    'purchase_id' => $purchase->id,
                    'code' => $companyCode . rand(1000000, 9999999),
                    'status' => 'available',
                    'expiration_date' => $offer->limit_date ?? now()->addMonth()
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Compra realizada correctamente',
                'purchase' => $purchase
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}