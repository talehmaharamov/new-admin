<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class GeneralPhotosPhotos extends Model
{
    public function generalphotos()
    {
        $this->belongsTo(GeneralPhotos::class);
    }
    protected $guarded = [];
    public $timestamps = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
