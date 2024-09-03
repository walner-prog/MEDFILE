<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB; // Importa la clase DB
use Spatie\Permission\Models\Permission;

class ClearPermissions extends Command
{
    protected $signature = 'permissions:clear';
    protected $description = 'Clear all permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('All permissions have been cleared.');
    }
}
