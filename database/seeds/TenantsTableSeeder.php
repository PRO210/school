<?php

use App\Models\{
    Plan,
    Tenant,
};
//
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder {

    //
    //
    public function run() {
        
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23882706000120',
            'name' => 'EspecializaTi',
            'url' => 'especializati',
            'email' => 'carlos@especializati.com.br',
        ]);
    }

}
