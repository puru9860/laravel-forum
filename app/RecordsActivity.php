<?php

namespace App;

use App\Models\Activity;
use ReflectionClass;


trait RecordsActivity
{


    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        foreach (static::getRecordEvents() as $event) {
            static::created(function ($model) use($event){
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    protected static function getRecordEvents()
    {
        return ['created'];
    }

    protected function recordActivity($event)
    {
        Activity::create([
            'user_id' => auth()->id(),
            'subject_id' => $this->id,
            'type' => $this->getActivityType($event),
            'subject_type' => get_class($this)
        ]);
    }

    protected function getActivityType($event)
    {
        return $event . '_' . strtolower((new ReflectionClass($this))->getShortName());
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
