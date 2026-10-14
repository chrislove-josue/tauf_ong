<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index', [
            'groups' => config('tauf.settings'),
            'values' => Setting::all_cached(),
        ]);
    }

    public function update(Request $request)
    {
        $allowed = collect(config('tauf.settings'))
            ->flatMap(fn ($group) => array_keys($group['fields']))
            ->all();

        $data = $request->validate([
            'settings' => ['nullable', 'array'],
        ]);

        foreach ($data['settings'] ?? [] as $key => $value) {
            if (in_array($key, $allowed, true)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        Setting::flush();

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres enregistrés.');
    }
}
