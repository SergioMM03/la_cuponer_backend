<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    public function run()
    {
        $offers = [];

        $titles = [
            'Descuento especial',
            '2x1 promoción',
            'Oferta limitada',
            'Combo especial'
        ];

        $descriptions = [
            'Promoción increíble',
            'Aprovecha ahora',
            'Solo por tiempo limitado',
            'No te lo pierdas'
        ];

        $details = [
            'Aplican restricciones',
            'Solo fines de semana',
            'Válido en sucursal',
            'Hasta agotar existencias'
        ];

        $companyId = 1;

        for ($companyId = 1; $companyId <= 15; $companyId++) {

            for ($i = 0; $i < 4; $i++) {

                $regular = rand(10, 50);
                $offer = $regular / 2;

                $offers[] = [
                    'company_id' => $companyId,
                    'title' => $titles[$i],
                    'regular_price' => $regular,
                    'offer_price' => $offer,
                    'start_date' => now(),
                    'end_date' => '2030-01-01',
                    'limit_date' => '2030-12-31',
                    'description' => $descriptions[$i],
                    'details' => $details[$i],
                    'status' => 'approved'
                ];
            }
        }

        Offer::insert($offers);
    }
}