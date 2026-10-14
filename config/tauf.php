<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paramètres éditables depuis le back-office (onglet « Paramètres »)
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'general' => [
            'label' => 'Général',
            'icon' => 'cog',
            'fields' => [
                'site_name' => ['label' => 'Nom du site', 'type' => 'text'],
                'site_tagline' => ['label' => 'Slogan', 'type' => 'text'],
                'site_description' => ['label' => 'Description (SEO)', 'type' => 'textarea'],
                'about_mission' => ['label' => 'Mission (résumé accueil)', 'type' => 'textarea'],
                'footer_text' => ['label' => 'Texte du pied de page', 'type' => 'textarea'],
            ],
        ],
        'contact' => [
            'label' => 'Contact',
            'icon' => 'phone',
            'fields' => [
                'contact_email' => ['label' => 'E-mail de contact', 'type' => 'text'],
                'contact_phone' => ['label' => 'Téléphone principal', 'type' => 'text'],
                'contact_phone2' => ['label' => 'Téléphone secondaire', 'type' => 'text'],
                'contact_address' => ['label' => 'Adresse', 'type' => 'textarea'],
                'contact_hours' => ['label' => 'Horaires', 'type' => 'text'],
                'contact_map' => ['label' => 'Lien / iframe Google Maps', 'type' => 'textarea'],
            ],
        ],
        'social' => [
            'label' => 'Réseaux sociaux',
            'icon' => 'share',
            'fields' => [
                'facebook_url' => ['label' => 'Facebook', 'type' => 'text'],
                'instagram_url' => ['label' => 'Instagram', 'type' => 'text'],
                'linkedin_url' => ['label' => 'LinkedIn', 'type' => 'text'],
                'youtube_url' => ['label' => 'YouTube', 'type' => 'text'],
                'twitter_url' => ['label' => 'X / Twitter', 'type' => 'text'],
                'tiktok_url' => ['label' => 'TikTok', 'type' => 'text'],
            ],
        ],
        'about' => [
            'label' => 'À propos & valeurs',
            'icon' => 'info',
            'fields' => [
                'about_vision' => ['label' => 'Vision', 'type' => 'textarea'],
                'about_values' => ['label' => 'Valeurs (une par ligne)', 'type' => 'textarea'],
            ],
        ],
        'support' => [
            'label' => 'Soutenir / Rejoindre',
            'icon' => 'heart',
            'fields' => [
                'donation_info' => ['label' => 'Informations pour faire un don', 'type' => 'textarea'],
                'donation_url' => ['label' => 'Lien plateforme de don (optionnel)', 'type' => 'text'],
                'join_info' => ['label' => 'Informations pour nous rejoindre', 'type' => 'textarea'],
                'join_email' => ['label' => 'E-mail candidatures / bénévolat', 'type' => 'text'],
            ],
        ],
        'seo' => [
            'label' => 'SEO & Analytics',
            'icon' => 'search',
            'fields' => [
                'seo_keywords' => ['label' => 'Mots-clés', 'type' => 'text'],
                'google_analytics' => ['label' => 'ID Google Analytics', 'type' => 'text'],
                'cookie_notice' => ['label' => 'Message bandeau cookies', 'type' => 'textarea'],
            ],
        ],
    ],
];
