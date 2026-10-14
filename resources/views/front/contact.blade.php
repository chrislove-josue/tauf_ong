@extends('layouts.front')

@section('title', 'Contact')

@section('content')
    <x-front.banner
        title="Contactez-nous"
        subtitle="Une question, un partenariat, une demande d'information ? Écrivez-nous."
        :crumbs="['Contact' => null]" />

    <section class="container-tauf py-16">
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="section-title mb-6 !text-2xl">Envoyez-nous un message</h2>

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-5 sm:grid-cols-2">
                        @csrf
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Nom complet <span class="text-tauf-red">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">E-mail <span class="text-tauf-red">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Téléphone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Sujet</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Message <span class="text-tauf-red">*</span></label>
                            <textarea name="message" rows="6" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">{{ old('message') }}</textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-semibold text-tauf-ink">Pièce jointe (optionnel)</label>
                            <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm file:mr-3 file:rounded-full file:border-0 file:bg-tauf-green-light file:px-4 file:py-2 file:text-tauf-green">
                            <p class="mt-1 text-xs text-tauf-gray">Formats acceptés : PDF, JPG, PNG, DOC. Taille max 5 Mo.</p>
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="btn-primary w-full sm:w-auto">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="rounded-2xl bg-tauf-green p-6 text-white">
                    <h3 class="font-display text-lg font-bold">Coordonnées</h3>
                    <ul class="mt-4 space-y-4 text-sm">
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            <span>{{ tauf_setting('contact_address', 'Cotonou, Bénin') }}</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012 4.2 2 2 0 014 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8 9.8a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
                            <span>{{ tauf_setting('contact_phone', '+229 00 00 00 00') }}@if (tauf_setting('contact_phone2'))<br>{{ tauf_setting('contact_phone2') }}@endif</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                            <a href="mailto:{{ tauf_setting('contact_email', 'contact@ongtauf.org') }}" class="underline">{{ tauf_setting('contact_email', 'contact@ongtauf.org') }}</a>
                        </li>
                        @if (tauf_setting('contact_hours'))
                            <li class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-tauf-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                <span>{{ tauf_setting('contact_hours') }}</span>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach (['facebook_url' => 'facebook', 'instagram_url' => 'instagram', 'linkedin_url' => 'linkedin', 'youtube_url' => 'youtube', 'twitter_url' => 'twitter'] as $key => $icon)
                        @if (tauf_setting($key))
                            <a href="{{ tauf_setting($key) }}" target="_blank" rel="noopener" class="flex h-10 w-10 items-center justify-center rounded-full bg-tauf-cream text-tauf-green transition hover:bg-tauf-green hover:text-white">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><use href="#icon-{{ $icon }}"/></svg>
                            </a>
                        @endif
                    @endforeach
                </div>

                @if (tauf_setting('contact_map'))
                    <div class="overflow-hidden rounded-2xl border border-gray-100">
                        @if (Str::startsWith(tauf_setting('contact_map'), '<'))
                            {!! tauf_setting('contact_map') !!}
                        @else
                            <a href="{{ tauf_setting('contact_map') }}" target="_blank" class="block bg-tauf-cream p-6 text-center text-sm font-semibold text-tauf-green">Voir sur la carte</a>
                        @endif
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
