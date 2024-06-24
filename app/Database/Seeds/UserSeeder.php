<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use App\Entities\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        // Générer des utilisateurs de test
        $users = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'professional_status' => 'Developer',
                'last_login' => date('Y-m-d H:i:s')
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane.doe@example.com',
                'phone' => '0987654321',
                'address' => '456 Main St',
                'professional_status' => 'Designer',
                'last_login' => date('Y-m-d H:i:s')
            ],
        ];

        foreach ($users as $userData) {
            $user = new User($userData);
            $userModel->save($user);
        }
    }
}
