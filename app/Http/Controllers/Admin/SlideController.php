<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.slides.index', ['slides' => Slide::orderBy('order')->paginate(20)]);
    }

    public function create()
    {
        return view('admin.slides.form', ['slide' => new Slide(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image'] = $this->storeFile($request->file('image'), 'slides');

        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Bannière créée.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deleteFile($slide->image);
            $data['image'] = $this->storeFile($request->file('image'), 'slides');
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Bannière mise à jour.');
    }

    public function destroy(Slide $slide)
    {
        $this->deleteFile($slide->image);
        $slide->delete();

        return back()->with('success', 'Bannière supprimée.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'text' => ['nullable', 'string', 'max:500'],
            'button_text' => ['nullable', 'string', 'max:80'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
