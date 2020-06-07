<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link type="text/css" rel="stylesheet" href="/css/style.css"/>
        <title>Memory O'Clock</title>
    </head>
    <body>
        <!-- ----------------------- -->
        <!--        Navbar           -->
        <!-- ----------------------- -->
        <nav class="navbar" role="navigation">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/">Accueil</a>
                    </li>
                    <li class="nav-item active">
                        <a href="/memory">Memory</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- ----------------------- -->
        <!--        Content          -->
        <!-- ----------------------- -->
        <section class="memory-game">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- ----------------------- -->
                        <!--      Memory game        -->
                        <!-- ----------------------- -->
                        <div class="card">
                            <div class="card-header flex flex-row">
                                <h3>Jeu de mémoire</h3>
                                <div class="ml-md mr-md flex-fill">
                                    <div class="progress-bar">
                                        <div class="progress-bar-inner"></div>
                                    </div>
                                </div>
                                <h3 class="time-elapse text-right"></h3>
                            </div>
                            <div class="card-content">
                                <div class="memory-board">
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

        <!-- load scripts at the end to improve loading performance -->
        <!-- the page is displayed as soon as possible and the scripts are loaded after -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="/js/memory-game.js"></script>

        <script>
            const memoryGame = new MemoryGame(60);
            memoryGame.startGame();
        </script>
    </body>
</html>
