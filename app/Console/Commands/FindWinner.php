<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Winner;
use Illuminate\Support\Facades\Log;

class FindWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'find:winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and store the user with the highest points as a winner';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $highestPoints = User::max('points');

        $usersWithHighestPoints = User::where('points', $highestPoints)->get();

        if ($usersWithHighestPoints->count() > 1) {
            // $this->info('There is a tie for the highest points. No winner is declared.');
            Log::info('There is a tie for the highest points. No winner is declared.');
            return;
        }

        $winner = $usersWithHighestPoints->first();

        Winner::create([
            'user_id' => $winner->id,
            'points' => $highestPoints,
            'won_at' => now(),
        ]);

        Log::info('Winner stored successfully. Id ->'.$winner->id);
        return Command::SUCCESS;
    }
}
