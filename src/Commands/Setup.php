<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06/01/19
 * Time: 11:23
 */

namespace AuthSetup\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Class Setup
 * @package AuthSetup\Commands
 */
class Setup extends Command
{
    protected $signature = 'auth-setup:setup';

    protected $description = 'Setup the basic acl';

    /**
     * Execute
     */
    public function handle()
    {
        Artisan::call('vendor:publish', ['--provider' => "AuthSetup\AuthSetupServiceProvider"]);
        $this->info('Published files complete!');
        Artisan::call('migrate');
        $this->info('Migrate table complete!');
        Artisan::call('make:auth');
        $this->info('Auth scaffold complete!');
        $this->info('Auth Setup complete!');
    }
}