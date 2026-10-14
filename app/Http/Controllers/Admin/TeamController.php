<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.team.index', ['members' => TeamMember::orderBy('order')->paginate(30)]);
    }

    public function create()
    {
        return view('admin.team.form', ['member' => new TeamMember(['is_active' => true, 'group' => 'bureau'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['photo'] = $this->storeFile($request->file('photo'), 'team');

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre ajouté.');
    }

    public function edit(TeamMember $member)
    {
        return view('admin.team.form', ['member' => $member]);
    }

    public function update(Request $request, TeamMember $member)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $this->deleteFile($member->photo);
            $data['photo'] = $this->storeFile($request->file('photo'), 'team');
        }

        $member->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre mis à jour.');
    }

    public function destroy(TeamMember $member)
    {
        $this->deleteFile($member->photo);
        $member->delete();

        return back()->with('success', 'Membre supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'role' => ['nullable', 'string', 'max:150'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'group' => ['required', 'string', 'max:50'],
            'order' => ['nullable', 'integer'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
