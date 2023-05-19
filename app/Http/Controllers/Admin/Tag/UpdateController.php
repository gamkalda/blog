<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return view('admin.tag.show', compact('tag'));
    }
}
