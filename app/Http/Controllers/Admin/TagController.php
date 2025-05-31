<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        $tag = Tag::create($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'tag_created',
            'description' => "Created tag: {$tag->name}",
        ]);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $oldName = $tag->name;
        $tag->update($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'tag_updated',
            'description' => "Updated tag from '{$oldName}' to '{$tag->name}'",
        ]);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->products()->count() > 0) {
            return redirect()->route('admin.tags.index')
                ->with('error', 'Cannot delete tag that is associated with products.');
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'tag_deleted',
            'description' => "Deleted tag: {$tag->name}",
        ]);

        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
} 