<?php

namespace App\Listeners;

use App\Events\CreateCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CreateCategoryListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateCategory $event): void
    {
        

        Cache::forget('cats');
        // $allCategory=Category::with('parent')->paginate(10);
        // Cache::put('cats',$allCategory);
    }
}
