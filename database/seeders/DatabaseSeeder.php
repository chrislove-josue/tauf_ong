<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Category;
use App\Models\Event;
use App\Models\Media;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->settings();
        $admin = $this->users();
        $categories = $this->categories();
        $this->pages();
        $this->programs();
        $this->projects();
        $this->posts($admin, $categories);
        $this->events();
        $this->media();
        $this->partners();
        $this->testimonials();
        $this->slides();
        $this->team();
        $this->stats();
    }

    protected function settings(): void
    {
        $settings = [
            'site_name' => 'ONG TAUF',
            'site_tagline' => "Ensemble pour l'éducation et la francophonie au Bénin",
            'site_description' => "L'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l'éducation, de la langue française et de la culture, notamment à travers la Dictée PGL Bénin.",
            'about_mission' => "L'ONG TAUF œuvre pour l'épanouissement des jeunes et le rayonnement de la francophonie au Bénin à travers des programmes éducatifs, culturels et sociaux.",
            'about_vision' => "Un Bénin où chaque jeune a accès à une éducation de qualité et rayonne par sa maîtrise de la langue française et de la culture.",
            'about_values' => "Éducation\nSolidarité\nExcellence\nFrancophonie\nIntégrité\nEngagement",
            'footer_text' => "ONG TAUF — Dictée PGL Bénin. Ensemble pour l'éducation et la francophonie.",
            'contact_email' => 'contact@ongtauf.org',
            'contact_phone' => '+229 01 00 00 00',
            'contact_phone2' => '+229 01 00 00 01',
            'contact_address' => 'Cotonou, République du Bénin',
            'contact_hours' => 'Lundi - Vendredi : 08h30 - 17h30',
            'contact_map' => '',
            'facebook_url' => 'https://facebook.com/',
            'instagram_url' => 'https://instagram.com/',
            'linkedin_url' => 'https://linkedin.com/',
            'youtube_url' => 'https://youtube.com/',
            'twitter_url' => '',
            'tiktok_url' => '',
            'donation_info' => "Vos dons financent nos programmes éducatifs et culturels : organisation de la Dictée PGL Bénin, dotation en fournitures scolaires, accompagnement des écoles et des jeunes.",
            'donation_url' => '',
            'join_info' => "Rejoignez l'ONG TAUF en tant que bénévole, adhérent, stagiaire ou collaborateur. Votre énergie et vos compétences sont précieuses pour faire vivre nos programmes.",
            'join_email' => 'recrutement@ongtauf.org',
            'seo_keywords' => 'ONG TAUF, Dictée PGL Bénin, éducation, francophonie, Bénin, ONG béninoise',
            'google_analytics' => '',
            'cookie_notice' => 'Ce site utilise des cookies pour améliorer votre expérience de navigation. En continuant, vous acceptez notre politique de confidentialité.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Setting::flush();
    }

    protected function users(): User
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@ongtauf.org'],
            [
                'name' => 'Administrateur TAUF',
                'password' => 'password',
                'role' => 'super_admin',
                'is_active' => true,
                'phone' => '+229 01 00 00 00',
                'bio' => "Administrateur principal du site de l'ONG TAUF.",
            ],
        );

        User::firstOrCreate(
            ['email' => 'editeur@ongtauf.org'],
            [
                'name' => 'Éditeur TAUF',
                'password' => 'password',
                'role' => 'editeur',
                'is_active' => true,
            ],
        );

        return $admin;
    }

    /**
     * @return array<string, Category>
     */
    protected function categories(): array
    {
        $data = [
            'Actualités' => 'actualite',
            'Communiqués' => 'actualite',
            'Dictée PGL Bénin' => 'actualite',
            'Événements' => 'evenement',
        ];

        $categories = [];

        foreach ($data as $name => $type) {
            $categories[$name] = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'type' => $type],
            );
        }

        return $categories;
    }

    protected function pages(): void
    {
        $pages = [
            ['title' => 'À propos', 'slug' => 'a-propos', 'subtitle' => "Découvrez l'ONG TAUF", 'body' => '<p>L\'ONG TAUF est une organisation non gouvernementale béninoise engagée dans la promotion de l\'éducation, de la langue française et de la culture.</p><p>À travers ses actions de terrain, ses partenariats et ses réalisations, l\'ONG TAUF œuvre pour l\'épanouissement des jeunes et le rayonnement de la francophonie au Bénin.</p>'],
            ['title' => 'Notre histoire', 'slug' => 'notre-histoire', 'subtitle' => 'Qui sommes-nous ?', 'body' => "<p>Fondée au Bénin, l'ONG TAUF est née de la volonté d'accompagner les jeunes dans leur parcours éducatif et de promouvoir la langue française.</p><p>Au fil des années, l'organisation a fédéré des milliers de participants autour de la passion des mots.</p><h2>Nos grandes étapes</h2><ul><li>Création de l'ONG TAUF.</li><li>Lancement de la Dictée PGL Bénin.</li><li>Déploiement de nouveaux programmes.</li><li>Développement de partenariats.</li></ul>"],
            ['title' => 'Mission, vision et valeurs', 'slug' => 'mission-vision-valeurs', 'subtitle' => 'Ce qui nous guide', 'body' => ''],
            ['title' => 'Nous soutenir', 'slug' => 'nous-soutenir', 'subtitle' => 'Faire un don', 'body' => "<p>Chaque contribution, quelle qu'elle soit, contribue à changer la vie de nombreux jeunes.</p><p>Vous pouvez soutenir l'ONG TAUF par un don financier, un don en nature, ou un partenariat.</p>"],
            ['title' => 'Nous rejoindre', 'slug' => 'nous-rejoindre', 'subtitle' => 'Bénévolat, adhésion, recrutement', 'body' => "<p>Vous souhaitez vous engager à nos côtés ? Plusieurs possibilités s'offrent à vous :</p><ul><li>Devenir bénévole lors de nos événements ;</li><li>Adhérer à l'association ;</li><li>Effectuer un stage ;</li><li>Postuler à nos offres d'emploi.</li></ul>"],
            ['title' => 'Mentions légales', 'slug' => 'mentions-legales', 'body' => "<h2>Éditeur du site</h2><p>ONG TAUF — Cotonou, République du Bénin.</p><h2>Hébergement</h2><p>Les informations relatives à l'hébergement seront complétées lors de la mise en ligne.</p><h2>Propriété intellectuelle</h2><p>L'ensemble des contenus présents sur ce site est protégé. Toute reproduction est interdite sans autorisation préalable.</p>"],
            ['title' => 'Politique de confidentialité', 'slug' => 'politique-de-confidentialite', 'body' => "<h2>Collecte des données</h2><p>Les données que vous nous transmettez via les formulaires (contact, newsletter) sont utilisées uniquement pour répondre à vos demandes et ne sont jamais cédées à des tiers.</p><h2>Cookies</h2><p>Ce site utilise des cookies de fonctionnement et de mesure d'audience. Vous pouvez à tout moment modifier vos préférences.</p><h2>Vos droits</h2><p>Vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour l'exercer, contactez-nous par e-mail.</p>"],
            ['title' => 'Questions fréquentes', 'slug' => 'faq', 'body' => ''],
        ];

        foreach ($pages as $i => $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page + ['status' => 'publie', 'order' => $i]);
        }
    }

    protected function programs(): void
    {
        $programs = [
            ['title' => 'Dictée PGL Bénin', 'subtitle' => 'Programme phare', 'excerpt' => "La grande dictée qui rassemble les élèves du Bénin autour de la langue française.", 'body' => "<p>La Dictée PGL Bénin est le programme phare de l'ONG TAUF. Elle rassemble chaque année des milliers d'élèves autour de la passion des mots et de la maîtrise de la langue française.</p><p>Ce programme a pour ambition de promouvoir l'excellence linguistique, de développer le goût de la lecture et de valoriser le français chez les jeunes Béninois, du primaire au secondaire. Il s'agit d'un véritable outil pédagogique et d'un moment de convivialité qui fédère toute la communauté éducative.</p><h2>Le règlement</h2><p>Les participants sont répartis par niveau. La dictée est organisée en plusieurs tours, jusqu'à la grande finale nationale. Chaque tour permet de sélectionner les meilleurs candidats qui accèdent au niveau suivant.</p><h2>Le palmarès</h2><p>Chaque édition récompense les meilleurs élèves avec des prix et des bourses scolaires. Au-delà des récompenses, ce sont la confiance en soi, l'effort et la persévérance qui sont valorisés.</p><h2>Notre impact</h2><p>Depuis sa création, ce programme a touché des milliers d'élèves et a contribué à améliorer significativement leurs compétences orthographiques et rédactionnelles.</p>", 'featured' => true, 'order' => 1],
            ['title' => 'Éveil à la lecture', 'subtitle' => 'Éducation', 'excerpt' => "Des ateliers pour donner le goût de la lecture aux plus jeunes.", 'body' => "<p>Ce programme propose des ateliers de lecture animés dans les écoles et les bibliothèques pour éveiller les enfants au plaisir de lire.</p>", 'featured' => true, 'order' => 2],
            ['title' => 'Concours d\'éloquence', 'subtitle' => 'Culture', 'excerpt' => "Un concours qui valorise l'art oratoire et la confiance en soi des jeunes.", 'body' => "<p>Le concours d'éloquence permet aux jeunes de développer leur expression orale, leur argumentation et leur confiance en public.</p>", 'featured' => true, 'order' => 3],
            ['title' => 'Bibliothèques solidaires', 'subtitle' => 'Social', 'excerpt' => "Dotation en livres et création d'espaces de lecture dans les écoles.", 'body' => "<p>Nous collectons et distribuons des livres pour créer des espaces de lecture accessibles aux élèves des zones rurales.</p>", 'featured' => false, 'order' => 4],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(['slug' => Str::slug($program['title'])], $program + ['status' => 'publie']);
        }
    }

    protected function projects(): void
    {
        $projects = [
            ['title' => 'Édition 2025 de la Dictée PGL Bénin', 'excerpt' => "Plus de 5 000 élèves mobilisés à travers tout le Bénin.", 'location' => 'Cotonou, Bénin', 'context' => "<p>L'édition 2025 de la Dictée PGL Bénin a rassemblé des élèves de toutes les régions du pays.</p>", 'objectives' => '<p>Promouvoir la langue française et récompenser les meilleurs élèves.</p>', 'results' => '<p>Plus de 5 000 participants, 200 écoles mobilisées et 30 lauréats récompensés.</p>', 'indicators' => [['label' => 'Élèves participants', 'value' => '5 000'], ['label' => 'Écoles', 'value' => '200'], ['label' => 'Lauréats', 'value' => '30']], 'started_at' => '2025-02-01', 'ended_at' => '2025-05-30', 'order' => 1],
            ['title' => 'Dotation en fournitures scolaires', 'excerpt' => "Distribution de kits scolaires aux élèves défavorisés.", 'location' => 'Zou, Bénin', 'context' => '<p>De nombreux élèves manquent de fournitures de base pour suivre leur scolarité.</p>', 'objectives' => '<p>Fournir des kits scolaires complets et lutter contre la déscolarisation.</p>', 'results' => '<p>1 200 kits distribués dans 15 écoles.</p>', 'indicators' => [['label' => 'Kits distribués', 'value' => '1 200'], ['label' => 'Écoles', 'value' => '15']], 'started_at' => '2024-09-01', 'ended_at' => '2024-11-30', 'order' => 2],
            ['title' => 'Ateliers de lecture dans les écoles', 'excerpt' => "Séances d'animation autour du livre pour les plus jeunes.", 'location' => 'Atlantique, Bénin', 'context' => '<p>Le goût de la lecture se développe dès le plus jeune âge.</p>', 'objectives' => '<p>Encourager la lecture chez les élèves du primaire.</p>', 'results' => '<p>50 ateliers organisés, 2 000 enfants sensibilisés.</p>', 'indicators' => [['label' => 'Ateliers', 'value' => '50'], ['label' => 'Enfants', 'value' => '2 000']], 'started_at' => '2025-01-15', 'ended_at' => '2025-04-15', 'order' => 3],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => Str::slug($project['title'])], $project + ['status' => 'publie']);
        }
    }

    /**
     * @param  array<string, Category>  $categories
     */
    protected function posts(User $admin, array $categories): void
    {
        $posts = [
            ['title' => 'Lancement officiel de la Dictée PGL Bénin 2026', 'category' => 'Dictée PGL Bénin', 'excerpt' => "L'ONG TAUF annonce le lancement de la nouvelle édition de la Dictée PGL Bénin, avec des inscriptions ouvertes dans toutes les écoles partenaires.", 'body' => "<p>C'est officiel : la nouvelle édition de la Dictée PGL Bénin est lancée ! Les inscriptions sont ouvertes dans les écoles partenaires à travers tout le pays. Cette édition marque une étape importante pour l'ONG TAUF qui, depuis plusieurs années, s'attache à faire rayonner la langue française auprès des jeunes Béninois.</p><p>Cette année encore, des milliers d'élèves sont attendus pour célébrer la langue française et la culture. La Dictée PGL Bénin s'inscrit dans une dynamique de valorisation du français, d'encouragement à la lecture et de stimulation de l'esprit critique des élèves du primaire et du secondaire.</p><p>L'objectif est de faire de cet événement un véritable rendez-vous éducatif et culturel qui mobilise enseignants, parents, élèves et partenaires autour d'une même passion : celle des mots. Les modalités d'inscription sont disponibles auprès des chefs d'établissement des écoles partenaires.</p>"],
            ['title' => "Nos actions de terrain pendant l'année scolaire", 'category' => 'Actualités', 'excerpt' => "Retour sur les activités menées par l'ONG TAUF auprès des écoles.", 'body' => "<p>Toute l'année, l'ONG TAUF mène des actions concrètes auprès des élèves et des enseignants : ateliers de lecture, distributions de fournitures scolaires, accompagnement pédagogique et valorisation de la lecture. Ces actions visent à améliorer la qualité de l'apprentissage et à favoriser l'accès à une éducation inclusive et équitable.</p><p>Grâce à la mobilisation de nos bénévoles, de nos enseignants et de nos partenaires, nous avons pu toucher un grand nombre d'écoles, notamment dans les zones rurales et périurbaines. Chaque intervention est l'occasion de créer un climat de motivation chez les élèves et de les encourager à donner le meilleur d'eux-mêmes.</p><p>Merci à tous nos bénévoles et partenaires pour leur engagement ! Ensemble, nous contribuons à bâtir un avenir meilleur pour les jeunes Béninois.</p>"],
            ['title' => 'Communiqué : résultats de la grande finale', 'category' => 'Communiqués', 'excerpt' => 'Découvrez le palmarès de la grande finale nationale.', 'body' => "<p>La grande finale nationale de la Dictée PGL Bénin a livré son verdict. Félicitations à tous les lauréats et à leurs encadreurs pour leur engagement, leur rigueur et leur passion pour la langue française.</p><p>Cette édition a été marquée par un niveau exceptionnel et une ambiance chaleureuse qui a réuni élèves, enseignants, parents et partenaires. Nous tenons à exprimer notre gratitude à l'ensemble des acteurs qui ont contribué au succès de cette manifestation.</p><p>Le palmarès complet sera publié sur notre site dans les prochains jours. Nous invitons tous les participants à garder le cap et à se préparer pour la prochaine édition !</p>"],
            ['title' => "Devenir bénévole pour l'ONG TAUF", 'category' => 'Actualités', 'excerpt' => "Rejoignez notre équipe de bénévoles et participez à nos programmes.", 'body' => "<p>Vous souhaitez vous engager pour l'éducation ? L'ONG TAUF recrute des bénévoles passionnés pour accompagner ses événements et ses programmes d'alphabétisation, de lecture et de promotion du français.</p><p>Que vous soyez étudiant, enseignant, professionnel ou tout simplement passionné d'éducation, votre contribution compte. Nous recherchons des bénévoles pour l'animation des ateliers, l'organisation des événements, la communication, l'accueil des participants et bien d'autres missions.</p><p>Contactez-nous dès aujourd'hui ! Votre engagement peut changer la vie d'un jeune.</p>"],
        ];

        foreach ($posts as $i => $data) {
            Post::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'category_id' => $categories[$data['category']]->id ?? null,
                    'user_id' => $admin->id,
                    'excerpt' => $data['excerpt'],
                    'body' => $data['body'],
                    'status' => 'publie',
                    'published_at' => now()->subDays($i * 3 + 1),
                ],
            );
        }
    }

    protected function events(): void
    {
        $events = [
            ['title' => 'Grande finale de la Dictée PGL Bénin 2026', 'excerpt' => "La finale nationale de la Dictée PGL Bénin réunit les meilleurs finalistes venus de toutes les régions.", 'location' => 'Palais des Congrès, Cotonou', 'starts_at' => now()->addDays(20)->setTime(9, 0), 'ends_at' => now()->addDays(20)->setTime(14, 0), 'body' => "<p>Après plusieurs tours préliminaires organisés dans les régions et les départements, les meilleurs candidats s'affrontent lors de la grande finale nationale de la Dictée PGL Bénin.</p><p>Cette journée est placée sous le signe de la célébration du français, de l'excellence et de la jeunesse. Elle sera marquée par des prestations, la remise des prix et la reconnaissance des efforts fournis par les élèves, leurs enseignants et leurs parents.</p><p>Nous invitons tous les amoureux de la langue française à assister à cet événement qui constitue un véritable rendez-vous culturel au Bénin.</p>"],
            ['title' => 'Atelier de formation des enseignants', 'excerpt' => 'Renforcement des capacités des encadreurs.', 'location' => 'Cotonou', 'starts_at' => now()->addDays(35)->setTime(8, 30), 'ends_at' => now()->addDays(35)->setTime(16, 0)],
            ['title' => 'Journée de lecture dans les écoles', 'excerpt' => "Une journée dédiée au livre et à la lecture.", 'location' => 'Écoles partenaires', 'starts_at' => now()->subDays(15)->setTime(9, 0), 'ends_at' => now()->subDays(15)->setTime(15, 0)],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['slug' => Str::slug($event['title'])], $event + ['status' => 'publie']);
        }
    }

    protected function media(): void
    {
        $albums = [
            ['name' => 'Dictée PGL Bénin 2025', 'description' => "Les meilleurs moments de l'édition 2025."],
            ['name' => 'Ateliers de lecture', 'description' => 'Nos ateliers dans les écoles.'],
            ['name' => 'Remise de prix', 'description' => 'Les lauréats à l\'honneur.'],
        ];

        foreach ($albums as $i => $album) {
            $created = Album::updateOrCreate(['slug' => Str::slug($album['name'])], $album + ['order' => $i]);

            for ($j = 1; $j <= 4; $j++) {
                Media::updateOrCreate(
                    ['file_path' => 'images/placeholder.svg', 'album_id' => $created->id, 'title' => $album['name'].' — photo '.$j],
                    ['type' => 'image', 'alt' => $album['name'], 'order' => $j, 'mime' => 'image/svg+xml'],
                );
            }
        }
    }

    protected function partners(): void
    {
        $partners = [
            ['name' => 'Ministère de l\'Éducation', 'category' => 'Institutions'],
            ['name' => 'Ambassade de France', 'category' => 'Partenaires institutionnels'],
            ['name' => 'Francophonie', 'category' => 'Partenaires institutionnels'],
            ['name' => 'Fondation partenaire', 'category' => 'Partenaires financiers'],
            ['name' => 'Entreprise mécène', 'category' => 'Partenaires financiers'],
            ['name' => 'Université partenaire', 'category' => 'Académique'],
        ];

        foreach ($partners as $i => $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                ['logo' => 'images/placeholder.svg', 'category' => $partner['category'], 'is_active' => true, 'order' => $i],
            );
        }
    }

    protected function testimonials(): void
    {
        $items = [
            ['name' => 'Aïcha S.', 'role' => 'Enseignante', 'content' => "La Dictée PGL Bénin motive énormément mes élèves. C'est un formidable outil pédagogique."],
            ['name' => 'Jean-Marc D.', 'role' => 'Parent d\'élève', 'content' => "Cette compétition a transformé le rapport de ma fille aux livres. Merci à l'ONG TAUF !"],
            ['name' => 'Fatou B.', 'role' => 'Lauréate', 'content' => "Participer à la Dictée PGL Bénin a été une expérience inoubliable qui m'a donné confiance en moi."],
        ];

        foreach ($items as $i => $item) {
            Testimonial::updateOrCreate(
                ['name' => $item['name']],
                ['role' => $item['role'], 'content' => $item['content'], 'is_active' => true, 'order' => $i],
            );
        }
    }

    protected function slides(): void
    {
        $slides = [
            ['title' => "Ensemble pour l'éducation et la francophonie au Bénin", 'subtitle' => 'ONG TAUF', 'text' => "Nous œuvrons pour l'épanouissement des jeunes à travers des programmes éducatifs, culturels et sociaux.", 'button_text' => 'Découvrir nos programmes', 'button_url' => '/programmes'],
        ];

        foreach ($slides as $i => $slide) {
            Slide::updateOrCreate(
                ['title' => $slide['title']],
                ['subtitle' => $slide['subtitle'], 'text' => $slide['text'], 'button_text' => $slide['button_text'], 'button_url' => $slide['button_url'], 'is_active' => true, 'order' => $i],
            );
        }
    }

    protected function team(): void
    {
        $members = [
            ['name' => 'Prénom Nom', 'role' => 'Président(e)', 'group' => 'bureau'],
            ['name' => 'Prénom Nom', 'role' => 'Secrétaire Général(e)', 'group' => 'bureau'],
            ['name' => 'Prénom Nom', 'role' => 'Trésorier(ère)', 'group' => 'bureau'],
            ['name' => 'Prénom Nom', 'role' => 'Coordonnateur(trice)', 'group' => 'equipe'],
        ];

        foreach ($members as $i => $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'role' => $member['role']],
                ['group' => $member['group'], 'photo' => 'images/placeholder.svg', 'is_active' => true, 'order' => $i],
            );
        }
    }

    protected function stats(): void
    {
        $stats = [
            ['label' => 'Élèves touchés', 'value' => '5000', 'suffix' => '+'],
            ['label' => 'Écoles partenaires', 'value' => '200', 'suffix' => '+'],
            ['label' => 'Éditions organisées', 'value' => '10', 'suffix' => ''],
            ['label' => 'Bénévoles engagés', 'value' => '120', 'suffix' => '+'],
        ];

        foreach ($stats as $i => $stat) {
            Stat::updateOrCreate(
                ['label' => $stat['label']],
                ['value' => $stat['value'], 'suffix' => $stat['suffix'], 'is_active' => true, 'order' => $i],
            );
        }
    }
}
