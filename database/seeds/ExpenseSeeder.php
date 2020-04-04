<?php

use Illuminate\Database\Seeder;
use App\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $items=[
        ['items'=> 'Transcript nikalda', 'amount'=> 700],
        ['items'=> 'khaja', 'amount'=> 300],
        ['items'=> 'scooty servicing', 'amount'=>300],
    ];
    foreach ($items as $item) {
        Expense::create($item); 
    }
    }
}
