<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 05/01/19
 * Time: 20:45
 */
use AuthSetup\Models\Role;
use AuthSetup\Tests\Fixtures\User;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Schema;
class AuthSetupTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [\AuthSetup\AuthSetupServiceProvider::class];
    }

    protected function setUp()
    {
        parent::setUp();
        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->artisan('migrate', ['--database' => 'testing']);
       if(!is_dir(__DIR__.'/../vendor/orchestra/testbench-core/src/Concerns/../../laravel/app')){
           mkdir(__DIR__.'/../vendor/orchestra/testbench-core/src/Concerns/../../laravel/app/Http/Controllers/', 0755, true);
       }
    }

    public function tearDown()
    {
        parent::tearDown();
        if(is_dir(resource_path('views/'))){
            $directory = resource_path('views/');
            exec("rm -rf $directory");
        }

    }
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('database.default', 'testing');
        $app['config']->set('user.model', 'AuthSetup\Tests\Fixtures\User');
    }
    /**
     * @test
     *
     */
    public function RolesTableIsEmpty()
    {
        $count = Role::count();
        $this->assertEquals(0, $count);
    }

    /**
     * @test
     *
     */
    public function RoleHasNoneUsers()
    {
        $role = Role::create(['name'=>'Administrator']);
        $this->assertEquals(0, $role->users()->count());
    }

    /**
     * @test
     *
     */
    public function UserHasRole()
    {
        $role = Role::create(['name'=>'Administrator']);
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123',
            'role_id' => $role->id
        ]);

        $this->assertEquals(0, $user->role()->count());
    }

    /**
     * @test
     *
     */
    public function CommandPublisheContent()
    {
        $this->artisan('auth-setup:setup');
        $this->assertTrue(Schema::hasSchema('roles'));
    }
}