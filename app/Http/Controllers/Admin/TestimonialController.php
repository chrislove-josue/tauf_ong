<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::orderBy('order')->paginate(20)]);
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['photo'] = $this->storeFile($request->file('photo'), 'testimonials');

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage ajouté.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $this->deleteFile($testimonial->photo);
            $data['photo'] = $this->storeFile($request->file('photo'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteFile($testimonial->photo);
        $testimonial->delete();

        return back()->with('success', 'Témoignage supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['nullable', 'string', 'max:150'],
            'content' => ['required', 'string', 'max:1000'],
            'order' => ['nullable', 'integer'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
