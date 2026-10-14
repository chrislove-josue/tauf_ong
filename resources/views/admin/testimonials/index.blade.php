@extends('layouts.admin')

@section('title', 'Témoignages')
@section('heading', 'Témoignages')
@section('subheading', 'Partagez les témoignages de vos bénéficiaires et partenaires')

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 p-4">
            <p class="text-sm text-tauf-gray">{{ $testimonials->total() }} témoignage(s)</p>
            <a href="{{ route('admin.testimonials.create') }}" class="btn-primary !py-2.5 text-xs">+ Nouveau témoignage</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse ($testimonials as $testimonial)
                <div class="flex items-start gap-4 p-4">
                    <img src="{{ upload_url($testimonial->photo, 'images/placeholder.svg') }}" alt="" class="h-12 w-12 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-tauf-ink">{{ $testimonial->name }} <span class="font-normal text-tauf-gray">— {{ $testimonial->role }}</span></p>
                        <p class="mt-1 text-sm text-tauf-gray">{{ Str::limit($testimonial->content, 140) }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="rounded-lg bg-tauf-green-light px-3 py-1.5 text-xs font-semibold text-tauf-green">Modifier</a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" data-confirm="Supprimer ce témoignage ?">
                            @csrf @method('DELETE')
                            <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Suppr.</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="py-10 text-center text-tauf-gray">Aucun témoignage.</p>
            @endforelse
        </div>
        @if ($testimonials->hasPages())<div class="border-t border-gray-100 p-4">{{ $testimonials->links() }}</div>@endif
    </div>
@endsection
