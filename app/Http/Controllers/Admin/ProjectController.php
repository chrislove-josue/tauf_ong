<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::orderBy('order')->latest()->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project(['status' => 'publie'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover'] = $this->storeFile($request->file('cover'), 'projects');
        $data['gallery'] = $this->storeGallery($request);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Réalisation créée.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);

        if ($request->hasFile('cover')) {
            $this->deleteFile($project->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'projects');
        }

        $newGallery = $this->storeGallery($request);

        if ($newGallery !== []) {
            $data['gallery'] = array_values(array_merge($project->gallery ?? [], $newGallery));
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Réalisation mise à jour.');
    }

    public function destroy(Project $project)
    {
        $this->deleteFile($project->cover);
        foreach ($project->gallery ?? [] as $image) {
            $this->deleteFile($image);
        }
        $project->delete();

        return back()->with('success', 'Réalisation supprimée.');
    }

    protected function storeGallery(Request $request): array
    {
        $paths = [];

        foreach ($request->file('gallery', []) as $file) {
            if ($file) {
                $paths[] = $this->storeFile($file, 'projects/gallery');
            }
        }

        return $paths;
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'context' => ['nullable', 'string'],
            'objectives' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:150'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date'],
            'status' => ['required', 'in:publie,brouillon'],
            'order' => ['nullable', 'integer'],
            'indicators' => ['nullable', 'array'],
            'indicators.*.label' => ['nullable', 'string', 'max:120'],
            'indicators.*.value' => ['nullable', 'string', 'max:60'],
            'cover' => ['nullable', 'image', 'max:4096'],
            'gallery.*' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['indicators'] = collect($request->input('indicators', []))
            ->filter(fn ($i) => filled($i['label'] ?? null))
            ->values()
            ->all();

        return $data;
    }
}
