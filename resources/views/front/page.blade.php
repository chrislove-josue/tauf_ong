@extends('layouts.front')

@section('title', $page->title)

@section('meta_description', $page->meta_description ?: $page->subtitle ?: $page->title)

@section('content')
    <x-front.banner
        :title="$page->title"
        :subtitle="$page->subtitle"
        :image="$page->cover"
        :crumbs="[$page->title => null]" />

    <section class="container-tauf py-16">
        <div class="mx-auto max-w-3xl">
            @if ($page->cover)
                <img src="{{ upload_url($page->cover) }}" alt="{{ $page->title }}" class="mb-8 w-full rounded-3xl object-cover">
            @endif
            <div class="prose-tauf">{!! $page->body !!}</div>
        </div>
    </section>
@endsection
