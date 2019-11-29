<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user with admin rights';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $issetUser = User::where('email', $this->argument('email'))->count() > 0;
        if ($issetUser) {
            $this->error('Email already exist');
            return false;
        }
        $user = new User([
            'name' => 'Admin',
            'email' => $this->argument('email'),
            'password' => \Hash::make($this->argument('password')),
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);
        $user->save();
        $this->info('Success ');
        return true;
    }
}
