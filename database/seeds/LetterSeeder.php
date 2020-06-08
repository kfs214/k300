<?php

use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //メッセージを100件作成
        factory(App\Letter::class, 100)->create();
    }
}
