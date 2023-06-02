<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke(Post $post)
    {
        //Следующая строка не является ошибкой, это баг PHP Intelephense.
        auth()->user()->likedPosts()->detach($post->id); 
        return redirect()->route('personal.liked.index');
    }
}
