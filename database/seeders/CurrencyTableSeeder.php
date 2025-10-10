<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name'   => 'Рубль',
            'symbol' => '₽'
        ]);

        Currency::create([
            'name'   => 'Доллар США',
            'symbol' => '$'
        ]);

        $this->command->info('Сurrencies seeded successfully!');
    }
}
