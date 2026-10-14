@extends('layouts.front')

@section('title', $program->title)

@section('meta_description', $program->meta_description ?: $program->excerpt ?: $program->title)

@section('og_image', upload_url($program->cover))

@section('content')
    <x-front.banner
        :title="$program->title"
        :subtitle="$program->subtitle"
        :image="$program->cover"
        :crumbs="['Programmes' => route('programs.index'), $program->title => null]" />

    <section class="container-tauf py-16">
        <div class="mb-6 text-sm text-tauf-gray">
            <x-front.views :count="$program->views" />
        </div>
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                @if ($program->cover)
                    <img src="{{ upload_url($program->cover) }}" alt="{{ $program->title }}" class="mb-8 w-full rounded-3xl object-cover">
                @endif
                <div class="prose-tauf">{!! $program->body ?: '<p>'.e($program->excerpt).'</p>' !!}</div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-2xl bg-tauf-green p-6 text-white">
                    <h3 class="font-display text-lg font-bold">Participer</h3>
                    <p class="mt-2 text-sm text-white/85">Intéressé(e) par ce programme ? Contactez-nous pour en savoir plus ou vous inscrire.</p>
                    <a href="{{ route('contact') }}" class="btn-gold mt-4 w-full !py-2.5 text-xs">Nous contacter</a>
                </div>
                @if ($others->isNotEmpty())
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-tauf-ink">Autres programmes</h3>
                        <ul class="mt-4 space-y-3">
                            @foreach ($others as $other)
                                <li>
                                    <a href="{{ route('programs.show', $other) }}" class="flex items-center gap-3 text-sm text-tauf-gray hover:text-tauf-green">
                                        <img src="{{ upload_url($other->cover) }}" alt="" class="h-12 w-12 rounded-lg object-cover">
                                        <span class="font-medium">{{ $other->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
