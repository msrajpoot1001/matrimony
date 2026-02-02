<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasDeleteMeta
{
    protected static function bootHasDeleteMeta()
    {
        static::deleting(function ($model) {

            // only for soft delete
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {

                // fill automatically if columns exist
                if ($model->isFillable('deleted_by') || array_key_exists('deleted_by', $model->getAttributes())) {
                    $model->deleted_by = Auth::id();
                }

                // delete_reason should already be set by controller (optional)
                // just ensure it does not crash if not present

                // IMPORTANT: avoid infinite loop
                $model->saveQuietly();
            }
        });
    }
}
