<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('departments')->insert([
            [
                'id' => 1,
                'name' => 'Software Engineer',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'UI/UX Designer',
                'created_at' => now(),
            ]
        ]);

        DB::table('site_settings')->insert([
            [
                'id' => 1,
                'site_name' => 'Project UAS Daysu',
                'site_description' => 'The project is a Laravel-based application that manages system settings, user roles, backups, and database operations. It includes features such as:

System Settings Management: Allows administrators to configure general system settings through a web interface.

User Roles: Supports multiple user roles such as admin, supervisor, and intern, each with specific permissions and access levels.

Backup and Restore: Provides functionality to create backups of the database and restore them when needed, ensuring data integrity and security.

Database Operations: Includes CRUD (Create, Read, Update, Delete) operations for entities like departments, tasks, daily reports, and user management.

Interface Design: Uses Bootstrap or similar frameworks for responsive and user-friendly interface design.

Additional Features: Integration with third-party services like social media (e.g., Instagram, Twitter) for enhanced user engagement and system functionality.

',
                'instagram' => 'https://www.instagram.com/callmerammz/',
                'twitter' => 'https://www.twitter.com/callmerammz/',
                'facebook' => 'https://www.facebook.com/callmerammz/',
                'linkedin' => 'https://www.linkedin.com/in/rama-dita-486a6b249/',
                'created_at' => now(),
            ]
        ]);




        // DB::table('users')->insert([
        //     [
        //         'name' => 'Admin User',
        //         'email' => 'admin@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'admin',
        //         'department_id' => null,
        //         'supervisor_id' => null,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'name' => 'Supervisor User',
        //         'email' => 'supervisor@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'supervisor',
        //         'department_id' => 2,
        //         'supervisor_id' => null,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'name' => 'Daysu',
        //         'email' => 'day@gmail.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'supervisor',
        //         'department_id' => 2,
        //         'supervisor_id' => null,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'name' => 'Magang User',
        //         'email' => 'magang@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'magang',
        //         'department_id' => 2,
        //         'supervisor_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],

        // ]);



        $adminRole = Role::create(['name' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor']);
        $magangRole = Role::create(['name' => 'magang']);

        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'department_id' => null,
                'supervisor_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'password' => Hash::make('password'),
                'department_id' => 2,
                'supervisor_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Daysu',
                'email' => 'day@gmail.com',
                'password' => Hash::make('password'),
                'department_id' => 2,
                'supervisor_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $admin = User::where('email', 'admin@example.com')->first();
        $supervisor = User::where('email', 'supervisor@example.com')->first();
        $dayUser = User::where('email', 'day@gmail.com')->first();

        $admin->assignRole($adminRole);
        $supervisor->assignRole($supervisorRole);
        $dayUser->assignRole($magangRole);

        $supervisor = User::where('email', 'supervisor@example.com')->first();

        DB::table('users')->insert([
            [
                'name' => 'Magang User',
                'email' => 'magang@example.com',
                'password' => Hash::make('password'),
                'department_id' => 2,
                'supervisor_id' => $supervisor->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $magangUser = User::where('email', 'magang@example.com')->first();
        $magangUser->assignRole($magangRole);



        // DB::table('supervisors')->insert([
        //     'id' => 1,
        //     'name' => 'supervisors',
        //     'email' => 'supervisors@softui.com',
        //     'role' => 'supervisors',
        //     'department_id' => 1,
        //     'phone_number' => '0878329372823',
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);



        // DB::table('interns')->insert([
        //     'id' => 1,
        //     'name' => 'Dayu Magang',
        //     'email' => 'dayu@gmail.com',
        //     'role' => 'magang',
        //     'supervisor_id' => 1,
        //     'phone_number' => '08732983283822',
        //     'address' => 'Jalan Tubuh no 4',
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('admin')->insert([
        //     'id' => 1,
        //     'name' => 'admin',
        //     'email' => 'admin@softui.com',
        //     'role' => 'admin',
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
}
