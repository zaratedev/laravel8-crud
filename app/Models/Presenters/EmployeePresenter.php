<?php

namespace App\Models\Presenters;

class EmployeePresenter extends Presenter
{
    /**
     * @var \App\Models\Employee
     */
    protected $model;

    /**
     * @return string
     */
    public function name()
    {
        return ucwords(mb_strtolower(trim($this->model->first_name).' '.trim($this->model->last_name)));
    }
}
