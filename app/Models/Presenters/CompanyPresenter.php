<?php

namespace App\Models\Presenters;

class CompanyPresenter extends Presenter
{
    /**
     * @var \App\Models\Company
     */
    protected $model;

    /**
     * Display the name of the company capitalized.
     *
     * @return string
     */
    public function name()
    {
        return ucwords(mb_strtolower(trim($this->model->name)));
    }

    /**
     * Display the logo url.
     *
     * @param  int  $width
     * @param  int  $height
     * @return void
     */
    public function logo($width = 100, $height = 100)
    {
        return $this->image($this->model->logo, $width, $height);
    }
}
