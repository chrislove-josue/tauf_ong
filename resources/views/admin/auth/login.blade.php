<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion · Administration ONG TAUF</title>
    <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-tauf-green-dark">
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="relative hidden items-center justify-center overflow-hidden p-12 lg:flex">
            <div class="absolute inset-0 bg-gradient-to-br from-tauf-green-dark via-tauf-green to-tauf-green-dark"></div>
            <div class="absolute -right-20 top-10 h-72 w-72 rounded-full bg-tauf-gold/20"></div>
            <div class="absolute -bottom-24 -left-16 h-72 w-72 rounded-full bg-tauf-red/20"></div>
            <div class="relative text-center text-white">
                <img src="{{ asset('logo.jpg') }}" alt="ONG TAUF" class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-tauf-gold">
                <h1 class="mt-6 font-display text-3xl font-extrabold">ONG TAUF</h1>
                <p class="mt-2 text-sm uppercase tracking-[0.3em] text-tauf-gold">Dictée PGL Bénin</p>
                <p class="mx-auto mt-6 max-w-sm text-sm text-white/80">Espace de gestion de contenu (CMS) réservé aux administrateurs et contributeurs de l'organisation.</p>
            </div>
        </div>

        <div class="flex items-center justify-center bg-white p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:hidden">
                    <img src="{{ asset('logo.jpg') }}" alt="ONG TAUF" class="mx-auto h-20 w-20 rounded-full object-cover ring-2 ring-tauf-gold">
                </div>
                <h2 class="font-display text-2xl font-extrabold text-tauf-ink">Connexion au back-office</h2>
                <p class="mt-1 text-sm text-tauf-gray">Veuillez saisir vos identifiants pour continuer.</p>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-tauf-ink">Adresse e-mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                               class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                    </div>
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-tauf-ink">Mot de passe</label>
                        <input type="password" name="password" id="password" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-tauf-green focus:outline-none focus:ring-1 focus:ring-tauf-green">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-tauf-gray">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-tauf-green focus:ring-tauf-green">
                        Se souvenir de moi
                    </label>
                    <button type="submit" class="btn-primary w-full">Se connecter</button>
                </form>

                <p class="mt-8 text-center text-xs text-tauf-gray">
                    <a href="{{ route('home') }}" class="font-semibold text-tauf-green hover:underline">← Retour au site public</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
