<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynza - L'intranet Réinventé 🚀</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Navigation -->
<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="#" class="text-2xl font-extrabold text-blue-600 tracking-wide hover:text-blue-700 transition">
                Lynza
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="#features" class="nav-link text-gray-700 hover:text-blue-600 font-medium transition">✨ Fonctionnalités</a>
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-600 font-medium transition">📌 À Propos</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-600 font-medium transition">📩 Contact</a>
            </div>

            <a href="{{ route('login') }}"
               class="hidden md:inline-block px-5 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition">
                🔑 Connexion
            </a>

            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden flex flex-col space-y-4 mt-2 bg-white shadow-lg rounded-lg p-4">
            <a href="#features" class="nav-link block text-gray-700 hover:text-blue-600 font-medium transition">✨ Fonctionnalités</a>
            <a href="#about" class="nav-link block text-gray-700 hover:text-blue-600 font-medium transition">📌 À Propos</a>
            <a href="#contact" class="nav-link block text-gray-700 hover:text-blue-600 font-medium transition">📩 Contact</a>
            <a href="{{ route('login') }}"
               class="block text-center px-5 py-2 bg-blue-600 text-white rounded-full shadow-md hover:bg-blue-700 transition">
                🔑 Connexion
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

<main class="mt-16">
    <!-- Hero Section -->
    <div class="relative bg-blue-50">
        <!-- Image de fond -->
        <img
            src="{{ asset('img/university.jpg') }}"
            alt="Image de fond pour Lynza"
            class="absolute inset-0 w-full h-full object-cover"
        >
        <!-- Couche de flou -->
        <div class="absolute inset-0 bg-white/60 backdrop-blur-xs"></div>

        <!-- Contenu -->
        <section class="relative text-center py-32">
            <h1 class="text-5xl font-extrabold text-blue-600">
                Lynza - L'Intranet Nouvelle Génération 🚀
            </h1>
            <a href="#features"
               class="mt-10 inline-block bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 text-lg font-semibold">
                🔍 Découvrir Lynza
            </a>
        </section>
    </div>

    <!-- Fonctionnalités Clés -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-600">⚡ Nos Fonctionnalités Clés</h2>
            <p class="text-center text-gray-600 mt-2 text-lg">Un intranet puissant, évolutif et conçu pour
                simplifier votre gestion quotidienne.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                <!-- Gestion des Événements -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Gestion des Événements</h3>
                    <p class="text-gray-600 mt-2">
                        Créez, planifiez et partagez des événements en quelques clics. Ajoutez une date, un lieu et
                        des détails
                        pour informer votre communauté. Les participants peuvent consulter un calendrier dynamique
                        et recevoir
                        des rappels automatisés.
                    </p>
                </div>

                <!-- Communication Simplifiée -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Communication Interne</h3>
                    <p class="text-gray-600 mt-2">
                        Une messagerie intégrée pour fluidifier les échanges entre membres, enseignants, élèves ou
                        collègues.
                        Centralisez vos discussions, partagez des fichiers et posez vos questions directement aux
                        administrateurs.
                    </p>
                </div>

                <!-- Ressources Documentaires -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Ressources Documentaires</h3>
                    <p class="text-gray-600 mt-2">
                        Un espace de stockage sécurisé pour partager des documents importants : supports de cours,
                        règlements,
                        guides pratiques… Organisez vos fichiers par catégories et offrez un accès rapide à vos
                        membres.
                    </p>
                </div>

                <!-- Actualités et Annonces -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Actualités et Annonces</h3>
                    <p class="text-gray-600 mt-2">
                        Diffusez facilement les actualités et annonces importantes au sein de votre structure.
                        Publiez des mises à jour, informez sur des événements à venir et gardez vos membres
                        connectés
                        aux informations essentielles.
                    </p>
                </div>

                <!-- Objets Perdus / Retrouvés -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Objets Perdus / Retrouvés</h3>
                    <p class="text-gray-600 mt-2">
                        Une solution simple pour signaler, rechercher et récupérer des objets perdus. Grâce à un
                        système de
                        filtrage par catégorie, date et lieu, retrouvez vos affaires plus facilement et facilitez
                        leur restitution.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nouveautés à venir -->
    <section id="upcoming-features" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-600">🪴 Prochaines Fonctionnalités</h2>
            <p class="text-center text-gray-600 mt-2 text-lg">Lynza évolue constamment ! Voici un aperçu des
                fonctionnalités à venir.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                <!-- Sondages et Enquêtes -->
                <div class="p-6 bg-yellow-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Sondages et Enquêtes</h3>
                    <p class="text-gray-600 mt-2">
                        Engagez votre communauté en recueillant des avis et en analysant des retours grâce à des
                        sondages interactifs.
                        Les résultats seront affichés sous forme de graphiques pour une analyse claire et rapide.
                    </p>
                </div>

                <!-- Notifications et Alertes -->
                <div class="p-6 bg-yellow-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">Notifications en Temps Réel</h3>
                    <p class="text-gray-600 mt-2">
                        Recevez des alertes instantanées pour les événements, annonces, messages et mises à jour.
                        Ne manquez plus aucune information importante grâce à un système de notifications
                        centralisé.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- À Propos -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-blue-600">💡 Pourquoi Lynza ?</h2>
            <p class="text-gray-600 mt-4 text-lg">
                Lynza est bien plus qu'un simple intranet. C'est un écosystème digital conçu pour renforcer la
                communication, la gestion et l'organisation au sein de votre structure.
                Facile à configurer, sécurisé et 100% personnalisable, Lynza vous offre une flexibilité sans
                précédent.
            </p>
            <p class="text-gray-600 mt-4 text-lg">Adoptez une solution moderne, adaptée à vos besoins et centrée sur
                l'efficacité !</p>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-blue-600">📩 Contactez-nous</h2>
            <p class="text-gray-600 mt-4 text-lg">Besoin d'une démo ? Une question ? Parlons-en !</p>
            <a href="mailto:contact@lynza.com"
               class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 text-lg font-semibold">
                📧 Envoyer un Email
            </a>
        </div>
    </section>
</main>
</body>
<script>
    // Fonction pour gérer le scroll avec animation
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth', // Animation fluide
                    block: 'start'     // Alignement au début
                });
            }
        });
    });
</script>
</html>
