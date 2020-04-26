<?php

    use App\Article;
    use App\Comment;
    use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'test@email.com',
            'password' => Hash::make('123456'),
        ]);

        factory(User::class)->create();

        factory(Article::class)->times(20)->create();
        factory(Comment::class)->times(10)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
