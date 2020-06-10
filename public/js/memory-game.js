class MemoryGame {
    // Instanciation du jeu avec une durée maximale en secondes
    constructor(maxDuration) {
        this.maxDuration = maxDuration;
        this.initGame();
    }

    /**
     * Instancie des valeurs par défaut pour toutes les variables qui seront utilisées
     */
    initGame() {
        this.startAt = null;
        this.nbCardsFound = 0;
        this.$previousCard = null;
        this.timerId = null;
        this.isActiveGame = false;

        // On récupère les éléments qui serviront à l'affichage du jeu
        // On utilise le prefix $ pour reconnaître un élément jQuery
        this.$board = $('.memory-board');
        this.$explanation = $('.memory-explanation');
        this.$cards = this.$board.find('.memory-card');

        // On compte le nombre de cartes en place
        this.nbCards = this.$cards.length;
    }

    /**
     * Démarre le jeu
     */
    startGame() {
        this.$board.removeClass('d-none');
        this.$explanation.addClass('d-none');
        this.isActiveGame = true;
        this.startAt = new Date();

        // Evènement lors du clic sur une carte
        this.$cards.click(($event) => this.selectCard($($event.target)));

        // La fonction setInterval permet de lancer une fonction toutes les xxx milisecondes
        // Cependant, elle le lance pour la première fois au bout de xxx milisecondes
        // On doit donc lancer notre fonction timer une première fois en amont pour démarrer immédiatement
        this.timer(this);
        // la fonction setInterval va éxécuter la fonction passé en paramètre en dehors de l'objet courant
        // On envoie donc l'élement this en paramètre pour utiliser les propriétés et fonctions de l'ojet courant
        this.timerId = setInterval(this.timer, 1000, this);
    }

    /**
     * Stoppe le jeu
     */
    stopGame() {
        this.isActiveGame = false;
        // On stop également le timer
        clearInterval(this.timerId);
    }

    /**
     * Méthode exécutée à interval régulier pour :
     * - Mettre à jour l'affichage du temps
     * - Stopper le jeu si le temps est écoulé
     *
     * @param $this objet courant du jeu
     */
    timer($this) {
        // récupère le temps écoulé
        const duration = $this.getDuration();
        // Lance la mise à jour de l'affichage du temps
        $this.updateDisplay(duration);

        // Stop le jeu si le temps est écoulé
        if (duration >= $this.maxDuration) {
            $this.stopGame();
            // Envoie la notification d'échec
            $this.notifFail();
        }
    }

    /**
     * Met à jour :
     * - La barre de progression
     * - Le temps restant
     *
     * @param timeElapse temps écoulé en secondes
     */
    updateDisplay(timeElapse) {
        // Calcul de la largeur de la barre de progression
        // On ajoute une unité de temps lors du calcul pour démarrer l'affichage de la barre dès la première seconde
        const progressWidth = Math.ceil((timeElapse + 1) * 100 / this.maxDuration);

        // Mise à jour de l'affichage de la barre de progression
        $('.memory-game .progress-bar-inner').css('width', `${progressWidth}%`);
        // Mise à jour de l'affichage du temps écoulé
        $('.memory-game .time-elapse').html(`${timeElapse} secs`);
    }

    /**
     * Récupère  le temps écoulé, arrondi en secondes
     *
     * @return {number} temps écoulé, arrondi en secondes
     */
    getDuration() {
        const now = new Date();

        return Math.round((now - this.startAt) / 1000);
    }

    /**
     * Envoie de la notification d'échec
     */
    notifFail() {
        Swal.fire({
            title: 'Temps écoulé',
            text: 'Tu feras mieux la prochaine fois !',
            showConfirmButton: false,
        });
    }

    /**
     * Envoie de la notification de succès
     * Permet de saisir son nom en fin de partie pour le tableau des scores
     *
     * @param duration temps de la partie en secondes
     */
    notifSuccess(duration) {
        Swal.fire({
            title: `Bravo ! Tu as terminé en ${duration} secondes.`,
            input: 'text',
            showCancelButton: false,
            confirmButtonText: 'Envoyer mon score !',
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                // Envoie d'une requête POST pour l'enregistrement
                const data = {'name': name, 'time': duration};
                $.post('/memory', data, function() {
                    // Retour OK de la requête
                    Swal.fire({icon: 'success'});
                }).fail(function(data) {
                    // Retour KO de la requête
                    Swal.fire({icon: 'error', text: data.responseJSON.error});
                });
            },
            // Désactive la fermeture de l'alerte tant que la réponse n'est pas reçue (ou en erreur)
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    /**
     * Action lors d'un clic sur une carte :
     * - Retourne la carte cliquée
     * - Met fin à la partie en cas de réussite
     *
     * @param $card élément jQuery de la carte cliquée
     */
    selectCard($card) {
        // On sors immédiatement de la fonction si le jeu est stoppé (non démarré ou terminé)
        if (this.isActiveGame === false) {
            return;
        }

        // On sors immédiatement si la carte est déjà retournée
        if ($card.hasClass('display-card')) {
            return;
        }

        // On retourne la carte
        this.displayCard($card);

        // Si c'est la première carte retournée
        // on set notre carte courant dans la variable de la carte précédente avant de sortir
        if (this.$previousCard === null) {
            this.$previousCard = $card;
            return;
        }

        // Si la carte précédente n'est pas la même que celle sélectionnée
        if (this.$previousCard.data('card') !== $card.data('card')) {
            // On retourne face cachée les 2 cartes
            this.hideSelectedCards(this.$previousCard, $card);
            return;
        }

        // On a réussi à trouver une paire identique
        // On réinitialise la carte précédente
        this.$previousCard = null;
        // On ajoute 2 cartes trouvées à notre compteur
        this.nbCardsFound += 2;

        // Si on a pas encore trouvé toutes les paires, on continue de jouer
        if (this.nbCardsFound < this.nbCards) {
            return;
        }

        // Sinon on stop le jeu
        this.stopGame();
        // On récupère le temps écoulé
        const duration = this.getDuration();
        // On envoie la notification de succès
        this.notifSuccess(duration);
    }

    /**
     * Retourne face visible la carte passée en paramètre
     *
     * @param $card élément jQuery de la carte
     */
    displayCard($card) {
        // La position de la carte correspond au fruit correspondant
        const position = $card.data('card') * 100;
        // On déplace l'image pour afficher le bon fruit
        $card.css('background-position', '0 -' + position + 'px');
        // On affiche la carte
        $card.addClass('display-card');
    }

    /**
     * Retourne face caché les 2 cartes passées en paramètre
     *
     * @param $previousCard élément jQuery de la carte précédente
     * @param $currentCard élément jQuery de la carte
     */
    hideSelectedCards($previousCard, $currentCard) {
        // On retire immédiatement la sélection de la carte pour permettre au joueur de cliquer sur les autres cartes
        // même si les 2 cartes courantes ne sont pas encore retournées
        this.$previousCard = null;
        // On attend un peu avant de retourner les 2 cartes (ce serait domage de ne pas voir quelle carte on a sélectionné !)
        setTimeout(function(){
            $previousCard.removeClass('display-card');
            $currentCard.removeClass('display-card');
        }, 500);
    }
}
