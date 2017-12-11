<?php
namespace HaganJones\LaravelObserveProperties\Tests;

use HaganJones\LaravelObserveProperties\Tests\App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ObservationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function creating_observation_is_observed()
    {
        User::create([
            'name' => 'Test Person',
            'email' => 'creating@example.org',
            'password' => bcrypt('password'),
        ]);

        $this->assertEquals('creating@example.org', session('creating_email'));
    }

    /** @test */
    public function created_observation_is_observed()
    {
        User::create([
            'name' => 'Test Person',
            'email' => 'created@example.org',
            'password' => bcrypt('password'),
        ]);

        $this->assertEquals('created@example.org', session('created_email'));
    }

    /** @test */
    public function updating_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'creating@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'updating@example.org',
        ]);

        $this->assertEquals('creating@example.org', session('updating_old_email'));
        $this->assertEquals('updating@example.org', session('updating_email'));
    }

    /** @test */
    public function updated_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'created@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'updated@example.org',
        ]);

        $this->assertEquals('created@example.org', session('updated_old_email'));
        $this->assertEquals('updated@example.org', session('updated_email'));
    }

    /** @test */
    public function saving_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'creating@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'saving@example.org',
        ]);

        $this->assertEquals('creating@example.org', session('saving_old_email'));
        $this->assertEquals('saving@example.org', session('saving_email'));
    }

    /** @test */
    public function saved_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'created@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'saved@example.org',
        ]);

        $this->assertEquals('created@example.org', session('saved_old_email'));
        $this->assertEquals('saved@example.org', session('saved_email'));
    }

    /** @test */
    public function deleting_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'deleting@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();

        $this->assertEquals('deleting@example.org', session('deleting_email'));
    }

    /** @test */
    public function deleted_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'deleted@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();

        $this->assertEquals('deleted@example.org', session('deleted_email'));
    }

    /** @test */
    public function restoring_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'restoring@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();
        $user->restore();

        $this->assertEquals('restoring@example.org', session('restoring_email'));
    }

    /** @test */
    public function restored_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'restored@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();
        $user->restore();

        $this->assertEquals('restored@example.org', session('restored_email'));
    }
}