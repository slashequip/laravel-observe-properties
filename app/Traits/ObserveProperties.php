<?php
namespace HaganJones\LaravelObserveProperties;

use Illuminate\Database\Eloquent\Model;

trait ObserveProperties
{
    /**
     * Listen to the Model creating event
     *
     * @param Model $model
     */
    public function creating(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Creating';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }

    /**
     * Listen to the Model created event
     *
     * @param Model $model
     */
    public function created(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Created';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }

    /**
     * Listen to the Model updating event
     *
     * @param Model $model
     */
    public function updating(Model $model)
    {
        return $this->callOnDirty($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Updating';
            return $this->attemptCall($method, $model, $model->getOriginal($attribute), $model->{$attribute});
        });
    }

    /**
     * Listen to the Model updated event
     *
     * @param Model $model
     */
    public function updated(Model $model)
    {
        return $this->callOnDirty($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Updated';
            return $this->attemptCall($method, $model, $model->getOriginal($attribute), $model->{$attribute});
        });
    }

    /**
     * Listen to the Model saving event
     *
     * @param Model $model
     */
    public function saving(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Saving';
            return $this->attemptCall($method, $model, $model->getOriginal($attribute), $model->{$attribute});
        });
    }

    /**
     * Listen to the Model saved event
     *
     * @param Model $model
     */
    public function saved(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Saved';
            return $this->attemptCall($method, $model, $model->getOriginal($attribute), $model->{$attribute});
        });
    }

    /**
     * Listen to the Model deleting event
     *
     * @param Model $model
     */
    public function deleting(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Deleting';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }

    /**
     * Listen to the Model deleted event
     *
     * @param Model $model
     */
    public function deleted(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Deleted';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }

    /**
     * Listen to the Model restoring event
     *
     * @param Model $model
     */
    public function restoring(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Restoring';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }

    /**
     * Listen to the Model restored event
     *
     * @param Model $model
     */
    public function restored(Model $model)
    {
        return $this->callOnClean($model, function ($attribute) use ($model) {
            $method = camel_case($attribute) . 'Restored';
            return $this->attemptCall($method, $model, $model->{$attribute});
        });
    }


    /**
     * Perform $callback on all Model dirty attributes
     *
     * @param Model $model
     * @param $callback
     */
    private function callOnDirty(Model $model, $callback)
    {
        return collect($model->getDirty())
            ->keys()
            ->filter(function ($attribute) use ($callback) {
                return $callback($attribute) === false;
            })->count() == 0;
    }

    /**
     * Perform $callback on all Model attributes
     *
     * @param Model $model
     * @param $callback
     */
    private function callOnClean(Model $model, $callback)
    {
        return collect($model->getAttributes())
            ->keys()
            ->filter(function ($attribute) use ($callback) {
                return $callback($attribute) === false;
            })->count() == 0;
    }

    /**
     * Check and make call to provided method name whilst passing all given arguments
     *
     * @param $method
     * @param array ...$args
     */
    private function attemptCall($method, ...$args)
    {
        if( method_exists($this, $method) ) {
            return $this->{$method}(...$args);
        }
    }
}