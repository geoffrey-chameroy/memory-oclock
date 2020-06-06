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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- ----------------------- -->
                        <!--      Memory game        -->
                        <!-- ----------------------- -->
                        <div class="card">
                            <div class="card-header">
                                <h3>Jeu de mémoire</h3>
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
        <!-- with this, the page is displayed as soon as possible and the scripts are loaded after -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>
            let $lastElement = null;
            let nbCards = null;
            let foundedCards = 0;
            let startAt = null;

            $(document).ready(function() {
                nbCards = $('.memory-board .memory-card').length;
                startAt = new Date();
            });

            // display a card on click
            $('.memory-board .memory-card').click(function() {
                // do nothing when the card is already displayed
                if ($(this).hasClass('display-card')) {
                    return;
                }

                // get card data to set the background position
                const position = $(this).data('card') * 100;
                $(this).css('background-position', '0 -' + position + 'px');
                // display the card
                $(this).addClass('display-card');

                // if no cards selected, set a new one
                if ($lastElement === null) {
                    $lastElement = $(this);
                    return;
                }

                // else, we check if it's success or fail
                // if card data equal the last one, success !
                if ($lastElement.data('card') === $(this).data('card')) {
                    $lastElement = null;
                    foundedCards += 2;
                    if (foundedCards === nbCards) {
                        const endAt = new Date();
                        const timeElapse = Math.round((endAt - startAt) / 1000);
                        alert(`Bravo ! Tu as terminé en ${timeElapse} secondes.`);
                    }
                    return;
                }

                // else, it's a fail !
                const $last = $lastElement;
                const $current = $(this);
                // remove immediately the selection to prevent clicks on other cards
                $lastElement = null;
                // wait a little to remove displayed cards
                setTimeout(function(){
                    $last.removeClass('display-card');
                    $current.removeClass('display-card');
                }, 500);
            });
        </script>
    </body>
</html>
