<?php

namespace App\Http\Controllers\Admin\User;


use App\Models\User;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
}
