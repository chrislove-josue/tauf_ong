@component('mail::message')
# Nouveau message depuis le site ONG TAUF

**Nom :** {{ $message->name }}
**E-mail :** {{ $message->email }}
@if ($message->phone)
**Téléphone :** {{ $message->phone }}
@endif
@if ($message->subject)
**Sujet :** {{ $message->subject }}
@endif

**Message :**

{{ $message->message }}

Merci,
Le site ONG TAUF
@endcomponent
