<?php
namespace HaganJones\LaravelObserveProperties\Tests\App\Observers;

use HaganJones\LaravelObserveProperties\ObserveProperties;
use HaganJones\LaravelObserveProperties\Tests\App\User;

class UserObserver
{
    use ObserveProperties {
        updating as updatingProperties;
    }

    public function updating(User $user) {
        // doing stuff

        $this->updatingProperties($user);
    }

    public function emailCreating(User $user, $value)
    {
        session(['creating_email' => $value]);
    }

    public function emailCreated(User $user, $value)
    {
        session(['created_email' => $value]);
    }

    public function emailUpdating(User $user, $oldValue, $newValue)
    {
        session(['updating_email' => $newValue]);
        session(['updating_old_email' => $oldValue]);
    }

    public function emailUpdated(User $user, $oldValue, $newValue)
    {
        session(['updated_email' => $newValue]);
        session(['updated_old_email' => $oldValue]);
    }

    public function emailSaving(User $user, $oldValue, $newValue)
    {
        session(['saving_email' => $newValue]);
        session(['saving_old_email' => $oldValue]);
    }

    public function emailSaved(User $user, $oldValue, $newValue)
    {
        session(['saved_email' => $newValue]);
        session(['saved_old_email' => $oldValue]);
    }

    public function emailDeleting(User $user, $value)
    {
        session(['deleting_email' => $value]);
    }

    public function emailDeleted(User $user, $value)
    {
        session(['deleted_email' => $value]);
    }

    public function emailRestoring(User $user, $value)
    {
        session(['restoring_email' => $value]);
    }

    public function emailRestored(User $user, $value)
    {
        session(['restored_email' => $value]);
    }
}