<?php

use Illuminate\Database\Seeder;
use App\Receive;

class ReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items=[
        ['items'=> 'Bishal Gaire', 'amount'=> 250],
        ['items'=> 'Ankit Karki', 'amount'=> 150],
        ['items'=> 'Alima Subedi', 'amount'=> 100],
    ];
    foreach ($items as $item) {
       Receive::create($item);
    }
  }
}
