# Laravel Observe Properties
A simple trait to allow you to observe changing properties on a Model.

When observing a model it is sometimes necessary to check to see if a particular property
on a model has changed, then perform an action. If you need to do this a lot then your
observer methods can soon become clogged up, hopefully this trait will help you out!

### Install via Composer
```
composer require "haganjones/laravel-observe-properties"
```

### To Use
Include the trait in your [Observation Classes](https://laravel.com/docs/5.4/eloquent#observers):
```php
<?php
 
namespace App\Observers;
 
use HaganJones\LaravelObserveProperties\ObserveProperties;
 
class UserObserver
{
    use ObserveProperties; 
}
```
Including this trait in your class allows you to make use of the `camelcaseProperty + Eventname` methods.
For example, following on from our `UserObserver` class above:
```php
// Inside UserObserver Class
 
public function emailUpdated(User $user, $oldValue, $newValue)
{
    $format = 'User %d changed their email from %s to %s';
    Log::info(sprintf($format, $user->id, $oldValue, $newValue));
    // User 1 changed their email from oldrusty@example.org to newshiny@example.org
}
```

### Available Events
All default Laravel Events are supported, please not some events will only receive one value.
See below for full list of events and arguments.

| Method                | Arguments Received                        |
|-----------------------|-------------------------------------------|
| yourPropertyCreating  | (Model $yourModel, $value)                |
| yourPropertyCreated   | (Model $yourModel, $value)                |
| yourPropertyUpdating  | (Model $yourModel, $oldValue, $newValue)  |
| yourPropertyUpdated   | (Model $yourModel, $oldValue, $newValue)  |
| yourPropertySaving    | (Model $yourModel, $oldValue, $newValue)  |
| yourPropertySaved     | (Model $yourModel, $oldValue, $newValue)  |
| yourPropertyDeleting  | (Model $yourModel, $value)                |
| yourPropertyDeleted   | (Model $yourModel, $value)                |
| yourPropertyRestoring | (Model $yourModel, $value)                |
| yourPropertyRestored  | (Model $yourModel, $value)                |

### Caveats
As per the Laravel docs the `Saving|Saved` events fire along
side `Creating|Created` and `Updating|Updated` methods.
 
With this in mind when **creating** a Model the `Saving|Saved` event will receive
both `$oldValue` and `$newValue` arguments but they will have the
**same** value.

### Using in existing Observer classes.
It is possible you would want to add this functionality inside your
existing Observer classes in this case you will need to include the
trait but give it's methods some aliases e.g
 
```php
<?php
 
namespace App\Observers;
 
use HaganJones\LaravelObserveProperties\ObserveProperties;
use App\User;
 
class UserObserver
{
    use ObserveProperties {
        updating as updatingProperties;
        //add in other method aliases here.
    }
    
    public function updating(User $user)
    {
        //Do things with $user
        
        return $this->updatingProperties($user);
    }
    
    public function firstNameUpdating(User $user, $oldValue, $newValue)
    {
        //$user->first_name was just updated.
    }
}
```

