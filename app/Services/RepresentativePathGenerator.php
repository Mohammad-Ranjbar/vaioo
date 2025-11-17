<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class RepresentativePathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $model = $media->model;

        if ($model instanceof \App\Models\Representative) {
            return 'representatives/' . $model->mobile . '/';
        }

        return $media->getKey() . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}