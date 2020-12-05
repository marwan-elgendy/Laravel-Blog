<?php

use Illuminate\Database\Seeder;

use App\User;

use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','marwanelgendy@gmail.com')->first();

        if(!$user) {
             User::create([
                'name' => 'Marwan Elgendy',
                'email' => 'marwanelgendy@gmail.com',
                'role' => 'admin',
                'about' => "i'm the developer of this project",
                'password' => Hash::make('m#9#2001')
             ]);
        }
    }
}
