<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Shop extends Component
{
    public $title ;
    public $breadcrumbs;
    /**
     * Create a new component instance.
     * اي بروبرتي معرفة ببلك هيا اوتو ماتك هيتم تمريرها للفيو 
     */
    public function __construct($title = 'null' , $breadcrumbs = true)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.shop');
    }
}
