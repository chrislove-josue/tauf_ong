<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.pages.index', ['pages' => Page::orderBy('order')->paginate(30)]);
    }

    public function create()
    {
        return view('admin.pages.form', ['page' => new Page(['status' => 'publie'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover'] = $this->storeFile($request->file('cover'), 'pages');

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page créée.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $this->validated($request, $page);

        if ($request->hasFile('cover')) {
            $this->deleteFile($page->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'pages');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour.');
    }

    public function destroy(Page $page)
    {
        $this->deleteFile($page->cover);
        $page->delete();

        return back()->with('success', 'Page supprimée.');
    }

    protected function validated(Request $request, ?Page $page = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'body' => ['nullable', 'string'],
            'template' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:brouillon,publie'],
            'meta_title' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'order' => ['nullable', 'integer'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
