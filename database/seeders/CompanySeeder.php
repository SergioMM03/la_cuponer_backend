<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [];
        $id = 1;

        for ($category = 1; $category <= 5; $category++) {
            for ($i = 1; $i <= 3; $i++) {

                $companies[] = [
                    'name' => "Empresa {$id}",
                    'code' => "EMP" . str_pad($id, 3, '0', STR_PAD_LEFT),
                    'address' => 'San Salvador',
                    'contact_name' => "Contacto {$id}",
                    'phone' => '7777' . str_pad($id, 4, '0', STR_PAD_LEFT),
                    'email' => "empresa{$id}@test.com",
                    'commission_percentage' => rand(5, 15),
                    'category_id' => $category
                ];

                $id++;
            }
        }

        Company::insert($companies);
    }
}