<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.programs.index', [
            'programs' => Program::orderBy('order')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.programs.form', ['program' => new Program(['status' => 'publie'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover'] = $this->storeFile($request->file('cover'), 'programs');

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Programme créé.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.form', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $this->validated($request);

        if ($request->hasFile('cover')) {
            $this->deleteFile($program->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'programs');
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Programme mis à jour.');
    }

    public function destroy(Program $program)
    {
        $this->deleteFile($program->cover);
        $program->delete();

        return back()->with('success', 'Programme supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:60'],
            'color' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:publie,brouillon'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['featured'] = $request->boolean('featured');

        return $data;
    }
}
