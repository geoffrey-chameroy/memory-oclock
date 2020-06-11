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
                    <!-- La classe active souligne le menu actif -->
                    <li class="nav-item active">
                        <a href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="/memory">Memory</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- ------------------------------------ -->
        <!--          Contenu de la page          -->
        <!-- ------------------------------------ -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <!-- ------------------------------------ -->
                        <!--          Tableau des scores          -->
                        <!-- ------------------------------------ -->
                        <div class="card">
                            <div class="card-header">
                                <h3>Tableaux des scores</h3>
                            </div>
                            <div class="card-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col" class="text-right">Temps</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Boucle sur la liste des scores enregistrés -->
                                        <?php foreach ($memories as $memory) { ?>
                                        <tr>
                                            <!-- Utilisation de htmlentities pour contrer la faille XSS -->
                                            <td><?php echo htmlentities($memory->name); ?></td>
                                            <!-- On force l'affichage de la valeur en entier par sécurité -->
                                            <td class="text-right"><?php echo (int) $memory->time; ?> secs</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="mt-sm text-center">
                                    <a href="/memory" class="btn btn-primary">Jouer !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
