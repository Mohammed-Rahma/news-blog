<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendingProduct extends Component
{
    public $products;
    public $title;
    public $count;
    /**
     * Create a new component instance.
     */
    public function __construct($title ,$count)
    {
        $this->title=$title;
        $this->count= $count;
        $this->products = Product::limit($count)->latest('updated_at')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.section.trending-product');
    }
}
