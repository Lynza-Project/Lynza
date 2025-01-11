<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynza - Plateforme d'Intranet</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="#" class="text-2xl font-extrabold text-blue-600 tracking-wide hover:text-blue-700 transition">
                Lynza
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="#features" class="text-gray-700 hover:text-blue-600 font-medium transition">Fonctionnalités</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium transition">À Propos</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
            </div>

            <a href="{{ route('login') }}"
               class="hidden md:inline-block px-5 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition">
                Connexion
            </a>

            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden flex flex-col space-y-4 mt-2 bg-white shadow-lg rounded-lg p-4">
            <a href="#features"
               class="block text-gray-700 hover:text-blue-600 font-medium transition">Fonctionnalités</a>
            <a href="#about" class="block text-gray-700 hover:text-blue-600 font-medium transition">À Propos</a>
            <a href="#contact" class="block text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
            <a href="{{ route('login') }}"
               class="block text-center px-5 py-2 bg-blue-600 text-white rounded-full shadow-md hover:bg-blue-700 transition">
                Connexion
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
    <div class="relative bg-blue-50">
        <section class="text-center py-32">
            <h1 class="text-4xl font-bold text-blue-600">Lynza - Votre intranet personnalisable</h1>
            <p class="mt-4 text-gray-600">Une solution modulable pour écoles, collèges et clubs.</p>
            <a href="#features" class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700">Découvrir</a>
        </section>

        <section id="features" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800">Fonctionnalités principales</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                    <div class="p-6 bg-blue-100 rounded-lg">
                        <h3 class="text-xl font-semibold">Gestion des événements</h3>
                        <p class="text-gray-600 mt-2">Créez et organisez facilement des événements pour votre
                            communauté.</p>
                    </div>
                    <div class="p-6 bg-blue-100 rounded-lg">
                        <h3 class="text-xl font-semibold">Module de communication</h3>
                        <p class="text-gray-600 mt-2">Messagerie interne pour un échange fluide entre les membres.</p>
                    </div>
                    <div class="p-6 bg-blue-100 rounded-lg">
                        <h3 class="text-xl font-semibold">Gestion des ressources</h3>
                        <p class="text-gray-600 mt-2">Partagez des documents et fichiers en toute simplicité.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-3xl font-bold text-gray-800">Pourquoi choisir Lynza ?</h2>
                <p class="text-gray-600 mt-4">
                    Lynza est une plateforme innovante qui permet aux institutions d'améliorer leur gestion interne
                    grâce à des outils et une interface intuitive.
                </p>
            </div>
        </section>

        <section id="contact" class="py-20 bg-white">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-3xl font-bold text-gray-800">Nous Contacter</h2>
                <p class="text-gray-600 mt-4">Une question ? Besoin d'une démo ? Contactez-nous !</p>
                <a href="mailto:contact@lynza.com"
                   class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700">Envoyer un
                    email</a>
            </div>
        </section>
    </div>

</main>

</body>
</html>
