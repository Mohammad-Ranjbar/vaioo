<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;

class Representative extends Model
{

    use Notifiable, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('national_card_front')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);

        $this->addMediaCollection('national_card_back')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);

        $this->addMediaCollection('selfie_with_card')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }
}
