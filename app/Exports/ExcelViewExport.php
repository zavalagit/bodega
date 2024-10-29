<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelViewExport implements FromView
{
    public $view;
    public $data;

    public function __construct($view, $data = "")
    {
        $this->view = $view;
        $this->data = $data;

        // dd($data);
    }

    public function view(): View
    {
        //dd($this->data);
        return view($this->view,['data' => $this->data]);
    }
}
