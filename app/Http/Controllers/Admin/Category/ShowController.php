<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }
}
