<?php

namespace App\Services;

use App\Models\Representative;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class RepresentativePathGenerator implements PathGenerator
{
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPath(Media $media): string
    {
        $model = $media->model;

        if ($model instanceof Representative) {
            return 'representatives/' . $model->mobile . '/';
        }

        return $media->getKey() . '/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}