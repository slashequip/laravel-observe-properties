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
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $this->assertEquals('test@example.org', session('creating_email'));
    }

    /** @test */
    public function created_observation_is_observed()
    {
        User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $this->assertEquals('test@example.org', session('created_email'));
    }

    /** @test */
    public function updating_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'another@example.org',
        ]);

        $this->assertEquals('test@example.org', session('updating_old_email'));
        $this->assertEquals('another@example.org', session('updating_email'));
    }

    /** @test */
    public function updated_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'another@example.org',
        ]);

        $this->assertEquals('test@example.org', session('updated_old_email'));
        $this->assertEquals('another@example.org', session('updated_email'));
    }

    /** @test */
    public function saving_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'another@example.org',
        ]);

        $this->assertEquals('test@example.org', session('saving_old_email'));
        $this->assertEquals('another@example.org', session('saving_email'));
    }

    /** @test */
    public function saved_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);

        $user->update([
            'email' => 'another@example.org',
        ]);

        $this->assertEquals('test@example.org', session('saved_old_email'));
        $this->assertEquals('another@example.org', session('saved_email'));
    }

    /** @test */
    public function deleting_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();

        $this->assertEquals('test@example.org', session('deleting_email'));
    }

    /** @test */
    public function deleted_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();

        $this->assertEquals('test@example.org', session('deleted_email'));
    }

    /** @test */
    public function restoring_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();
        $user->restore();

        $this->assertEquals('test@example.org', session('restoring_email'));
    }

    /** @test */
    public function restored_observation_is_observed()
    {
        $user = User::create([
            'name' => 'Test Person',
            'email' => 'test@example.org',
            'password' => bcrypt('password'),
        ]);
        $user->delete();
        $user->restore();

        $this->assertEquals('test@example.org', session('restored_email'));
    }
}