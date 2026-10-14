<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.users.index', [
            'users' => User::orderBy('name')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User(['role' => 'editeur', 'is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['password'] = Hash::make($data['password']);
        $data['photo'] = $this->storeFile($request->file('photo'), 'avatars');

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user);

        if (filled($data['password'] ?? null)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            $this->deleteFile($user->photo);
            $data['photo'] = $this->storeFile($request->file('photo'), 'avatars');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Vous ne pouvez pas supprimer votre propre compte.');

        $this->deleteFile($user->photo);
        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }

    protected function validated(Request $request, ?User $user = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user?->id)],
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'phone' => ['nullable', 'string', 'max:40'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
