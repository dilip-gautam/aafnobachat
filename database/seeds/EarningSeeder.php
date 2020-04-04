<?php

use Illuminate\Database\Seeder;
use App\Earning;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //   DB::table('users')->insert([
    //         'name' => Str::random(10),
    //         'email' => Str::random(10).'@gmail.com',
    //         'password' => Hash::make('password'),
    //     ]);
    $items=[
        ['items'=> 'salary ko saving', 'amount'=> 3000],
        ['items'=> 'mama lae dinuvako', 'amount'=> 700],
        ['items'=> 'Freelancing Bata', 'amount'=> 1300],
    ];
    foreach ($items as $item) {
        Earning::create($item);
    }
    }
}
