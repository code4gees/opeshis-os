<?php

namespace App\Traits;

use App\Observers\AuditObserver;

trait Auditable
{
    /**
     * Boot the Auditable trait for the model.
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            \App\Helpers\Opeshis::logAction('CREATE_' . strtoupper($model->getTable()), $model->getTable(), $model->id, $model->getAttributes());
        });

        static::updated(function ($model) {
            \App\Helpers\Opeshis::logAction('UPDATE_' . strtoupper($model->getTable()), $model->getTable(), $model->id, $model->getDirty());
        });

        static::deleted(function ($model) {
            \App\Helpers\Opeshis::logAction('DELETE_' . strtoupper($model->getTable()), $model->getTable(), $model->id);
        });
    }
}
