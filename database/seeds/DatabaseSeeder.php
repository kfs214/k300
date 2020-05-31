<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //自分のアカウントを作成、パスワードは'password'
        factory(App\User::class)->create(
          ['uname' => '牛島一樹', 'email' => 'info@kfs214.net']
        );

        //自分以外に10人のユーザーを作成
        factory(App\User::class, 10)->create();

        //user_id == 1 つまり「牛島一樹」に100人メンバーを登録
        factory(App\TeamMember::class, 100)->create();

        //掲示板を10件作成
        factory(App\Board::class, 10)->create();

        //投稿を100件作成
        factory(App\Post::class, 100)->create();

        $faker = Faker\Factory::create();
        //中間テーブルに情報追加
        for($i =7; $i < 80; $i++){
            DB::table('user_board')->insert([
              'user_id' => floor( $i / 10 ) + 1,
              'board_id' => $i % 10 + 1,
              'notify' => $faker->boolean,
            ]);
        }
    }
}
