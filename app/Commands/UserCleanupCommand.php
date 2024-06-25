<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Services;

class UserCleanupCommand extends BaseCommand
{
    protected $group = 'Maintenance';
    protected $name = 'users:cleanup';
    protected $description = 'Removes users who have been inactive for more than 36 months.';

    public function run(array $params)
    {
        $userService = Services::userService();

        CLI::write('Deletion of users who have been inactive for more than 36 months...', 'yellow');

        $deletedCount = $userService->removeInactiveUsers(36);

        CLI::write(sprintf('Deletion complete. %d users deleted.', $deletedCount), 'green');
    }
}
