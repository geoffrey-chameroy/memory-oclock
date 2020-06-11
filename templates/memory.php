<!DOCTYPE html>
<!-- Initialisation de la langue pour être reconnu par le navigateur (SEO également) -->
<html lang="fr-FR">
    <head>
        <!-- Initialisation de charset utf-8 pour afficher correctement les caractères spéciaux -->
        <meta charset="utf-8">
        <!-- Initialisation de la largeur des smartphones et tablettes pour éviter un zoom -->
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <!-- Import de la feuille de style -->
        <link type="text/css" rel="stylesheet" href="/css/style.css"/>
        <!-- Titre de l'onglet du navigateur (Utilisé également pour le SEO) -->
        <title>Memory O'Clock</title>
    </head>
    <body>
        <!-- ------------------------------------ -->
        <!--        Barre de navigation           -->
        <!-- ------------------------------------ -->
        <nav class="navbar" role="navigation">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/">Accueil</a>
                    </li>
                    <!-- La classe active souligne le menu actif -->
                    <li class="nav-item active">
                        <a href="/memory">Memory</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- ------------------------------------ -->
        <!--          Contenu de la page          -->
        <!-- ------------------------------------ -->
        <section class="memory-game">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- ------------------------------------ -->
                        <!--            Jeu de mémoire            -->
                        <!-- ------------------------------------ -->
                        <div class="card">
                            <!-- Titre du bloc -->
                            <div class="card-header d-flex flex-row">
                                <h3>Jeu de mémoire</h3>
                                <!-- L'affichage de la barre de progression est initialisé lorsque le jeu démarre -->
                                <div class="ml-md mr-md flex-fill">
                                    <div class="progress-bar">
                                        <div class="progress-bar-inner"></div>
                                    </div>
                                </div>
                                <!-- L'affichage du temps restant est initialisé lorsque le jeu démarre -->
                                <h3 class="time-elapse text-right"></h3>
                            </div>
                            <div class="card-content">
                                <!-- Ce bloc est affiché tant que le jeu n'a pas démarré -->
                                <div class="memory-explanation text-center">
                                    <p>Tu as 60 secondes pour trouver toutes les paires de fruits, amuse toi bien !</p>
                                    <!-- Au clic de ce bouton, le jeu démarre -->
                                    <a onclick="memoryGame.startGame()" class="mt-md btn btn-primary">C'est parti !</a>
                                </div>
                                <!-- Ce bloc est affiché uniquement lorsque le jeu a démarré -->
                                <div class="d-none memory-board">
                                    <!-- On boucle sur la liste des cartes pour les afficher face cachée -->
                                    <?php foreach ($cards as $key => $value) { ?>
                                    <figure data-card="<?php echo $value; ?>" class="memory-card"></figure>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chargement des scripts à la fin pour optimiser le chargement de la page -->
        <!-- Chargement du script jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Chargement du script Sweat Alert pour l'affichage des alertes -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Chargement du script du jeu -->
        <script src="/js/memory-game.js"></script>

        <!-- Instanciation du jeu -->
        <script>
            const memoryGame = new MemoryGame(60);
        </script>
    </body>
</html>
