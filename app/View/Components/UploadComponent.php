<?php
namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadComponent extends Component
{
    public $label;
    public $id;

    public function __construct($label,$id)
    {
        $this->label = $label;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.upload-component');
    }
}