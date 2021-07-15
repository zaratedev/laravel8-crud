<?php

namespace App\Models\Presenters;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

abstract class Presenter
{
    public const DASH = '-';
    public const EN_DASH = '–';
    public const EM_DASH = '—';

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @param  string|null  $image
     * @param  mixed  $width
     * @param  mixed  $height
     * @return string
     */
    public function image(?string $image, $width, $height)
    {
        if ($image) {
            return Storage::url($image);
        }

        return $this->placeholder($width, $height);
    }

    /**
     * @param  mixed  $width
     * @param  mixed  $height
     * @return string
     */
    protected function placeholder($width, $height): string
    {
        if ($height === 'auto') {
            return "https://via.placeholder.com/{$width}?text=Laravel";
        }

        if ($width === 'auto') {
            return "https://via.placeholder.com/{$height}?text=Laravel";
        }

        return "https://via.placeholder.com/{$width}x{$height}?text=Laravel";
    }

    /**
     * Allow for property-style retrieval.
     *
     * @param  mixed  $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->$property();
        }

        return $this->model->$property;
    }

    /**
     * Provide compatibility for the 'or' syntax in blade templates.
     *
     * @param  mixed  $property
     * @return bool
     */
    public function __isset($property): bool
    {
        return method_exists($this, $property);
    }
}