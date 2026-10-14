<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        return view('front.programs.index', [
            'programs' => Program::published()->orderBy('order')->get(),
        ]);
    }

    public function show(Program $program)
    {
        abort_unless($program->status === 'publie', 404);

        $program->recordView();

        return view('front.programs.show', [
            'program' => $program,
            'others' => Program::published()->whereKeyNot($program->id)->orderBy('order')->take(3)->get(),
        ]);
    }
}
