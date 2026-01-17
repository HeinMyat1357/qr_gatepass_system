<?php

namespace App\Console\Commands;

use App\Models\TemporaryPass;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteExpiredUsers extends Command
{
    protected $signature = 'users:delete-expired';

    protected $description = 'Delete users who registered more than 6 hours ago and not verified';

    public function handle()
    {
        $expiredUsers = TemporaryPass::
            where('created_at', '<', Carbon::now()->subHours(6))
            ->get();

        foreach ($expiredUsers as $user) {
            $this->info("Deleting user: {$user->visitor_email}");
            $user->delete();
        }

        $this->info('Expired users deleted successfully.');
    }
}
