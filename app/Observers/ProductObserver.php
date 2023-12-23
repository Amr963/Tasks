<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\product;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     */
    public function created(product $product): void
    {
        Category::create([
            'name' => 'category 1 from observer'
        ]);
    }

    /**
     * Handle the product "updated" event.
     */
    public function updated(product $product): void
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     */
    public function deleted(product $product): void
    {
        //
    }

    /**
     * Handle the product "restored" event.
     */
    public function restored(product $product): void
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     */
    public function forceDeleted(product $product): void
    {
        //
    }
}
