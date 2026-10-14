<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Media;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('front.realisations.index', [
            'projects' => Project::published()->orderBy('order')->latest()->paginate(9),
            'albums' => Album::withCount('images')->orderBy('order')->get(),
            'documents' => Media::where('type', 'document')->orderBy('order')->get(),
            'videos' => Media::where('type', 'video')->orderBy('order')->get(),
        ]);
    }

    public function show(Project $project)
    {
        abort_unless($project->status === 'publie', 404);

        $project->recordView();

        return view('front.projects.show', [
            'project' => $project,
            'others' => Project::published()->whereKeyNot($project->id)->latest()->take(3)->get(),
        ]);
    }
}
