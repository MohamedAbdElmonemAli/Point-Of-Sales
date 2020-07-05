<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['mohamed', 'ahmed'];

        foreach ($clients as $client)
        {
            \App\Client::create([
                'name' => $client,
                'phone' => '12020200',
                'address' => 'haram',
            ]);
        }
    }
}
