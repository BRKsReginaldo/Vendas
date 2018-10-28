<?php

use Illuminate\Database\Seeder;

class PlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = [
            [
                'name' => 'A vista',
                'value' => 1
            ]
        ];

        $others = collect(range(2, 12))->map(function ($value) {
            return [
                'name' => $value . ' parcelas',
                'value' => $value
            ];
        })->toArray();

        $all = array_merge($first, $others);

        foreach($all as $plot) {
            \App\Plot::create($plot);
        }
    }
}
