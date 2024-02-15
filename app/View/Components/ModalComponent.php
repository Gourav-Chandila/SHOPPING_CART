<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalComponent extends Component
{
    public $id,$title,$footerBtnName1,$footerBtnName2;
    public function __construct($id, $title, $footerBtnName1, $footerBtnName2)
    {
        $this->id = $id;
        $this->title = $title;
        $this->footerBtnName1 = $footerBtnName1;
        $this->footerBtnName2 = $footerBtnName2;
    }

    public function render(): View|Closure|string
    {
        return view('components.modal-component');
    }
}
