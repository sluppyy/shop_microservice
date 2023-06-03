<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:create-admin {name} {email} {password}';

    /**
     * The console command description.
     */
    protected $description = 'Create new admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User(
            [
                'name' => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => Hash::make($this->argument('password')),
            ]
        );
        $user->save();
    }
}