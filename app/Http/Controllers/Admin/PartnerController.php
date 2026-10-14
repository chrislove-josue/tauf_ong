<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.partners.index', ['partners' => Partner::orderBy('order')->paginate(30)]);
    }

    public function create()
    {
        return view('admin.partners.form', ['partner' => new Partner(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['logo'] = $this->storeFile($request->file('logo'), 'partners');

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire ajouté.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $this->deleteFile($partner->logo);
            $data['logo'] = $this->storeFile($request->file('logo'), 'partners');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire mis à jour.');
    }

    public function destroy(Partner $partner)
    {
        $this->deleteFile($partner->logo);
        $partner->delete();

        return back()->with('success', 'Partenaire supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'url' => ['nullable', 'url', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
