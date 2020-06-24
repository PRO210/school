<?php

use App\Models\{
    Tenant,
};
use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'André Freitas da Silva',
            'email' => 'proandre21@hotmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
