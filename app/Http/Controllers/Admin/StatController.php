<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        return view('admin.stats.index', ['stats' => Stat::orderBy('order')->paginate(30)]);
    }

    public function create()
    {
        return view('admin.stats.form', ['stat' => new Stat(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        Stat::create($this->validated($request));

        return redirect()->route('admin.stats.index')->with('success', 'Chiffre clé ajouté.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.form', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $stat->update($this->validated($request));

        return redirect()->route('admin.stats.index')->with('success', 'Chiffre clé mis à jour.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();

        return back()->with('success', 'Chiffre clé supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:150'],
            'value' => ['required', 'string', 'max:60'],
            'suffix' => ['nullable', 'string', 'max:20'],
            'icon' => ['nullable', 'string', 'max:60'],
            'order' => ['nullable', 'integer'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
