<?php

namespace App\Console\Commands;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class ReHashPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rehash:passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rehash all plaintext';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Users::all();

    foreach ($users as $user) {

        // Only rehash if it's NOT already hashed
        if (!Hash::needsRehash($user->Password)) {
            $this->info("Already hashed: UserID {$user->UserID}");
            continue;
        }

        $user->Password = Hash::make($user->Password);
        $user->save();

        $this->info("Rehashed user ID: " . $user->id);
    }

    $this->info("Done.");
    }
}
