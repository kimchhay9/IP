<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ModelActivityObserver
{
    /**
     * Handle the "created" event.
     */
    public function created(Model $model): void
    {
        ActivityLog::create([
            'model'    => get_class($model),//store class name of model
            'model_id' => $model->id,//store id of model
            'action'   => 'created',//store action
            'changes'  => json_encode($model->toArray()),//Converts the model’s attributes to JSON and stores them in the database.
        ]);
    }

    /**
     * Handle the "updated" event.
     */
    public function updated(Model $model): void
    {
        ActivityLog::create([
            'model'    => get_class($model),
            'model_id' => $model->id,
            'action'   => 'updated',
            'changes'  => json_encode([
                'old' => $model->getOriginal(),//get original values of model
                'new' => $model->getChanges(),//get changes made to model
            ]),
        ]);
    }

    /**
     * Handle the "deleted" event (soft delete).
     */
    public function deleted(Model $model): void
    {
        ActivityLog::create([
            'model'    => get_class($model),
            'model_id' => $model->id,
            'action'   => 'deleted',
            'changes'  => json_encode($model->toArray()),
        ]);
    }
}