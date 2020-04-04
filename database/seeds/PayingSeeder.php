<?php

use Illuminate\Database\Seeder;
use App\Paying;

class PayingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items=[
        ['items'=> 'Hemant Dai', 'amount'=> 1500],
        ['items'=> 'Dilip Gautam', 'amount'=> 800],
        ['items'=> 'Jitendra Sharma', 'amount'=> 700 ],
    ];
    foreach ($items as $item) {
        Paying::create($item);
    }
  }
}
