<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link type="text/css" rel="stylesheet" href="style.css"/>
        <title>Memory O'Clock</title>
    </head>
    <body>
        <!-- ----------------------- -->
        <!--        Navbar           -->
        <!-- ----------------------- -->
        <nav class="navbar" role="navigation">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="memory.php">Memory</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ----------------------- -->
        <!--        Content          -->
        <!-- ----------------------- -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <!-- ----------------------- -->
                        <!--      Score Card         -->
                        <!-- ----------------------- -->
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
                                        <tr>
                                            <td>Jane Doe</td>
                                            <td class="text-right">25 secs</td>
                                        </tr>
                                        <tr>
                                            <td>John Doe</td>
                                            <td class="text-right">65 secs</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-sm text-center">
                                    <a href="#" class="btn btn-primary">Jouer !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
