class MemoryGame {
    constructor(maxDuration) {
        this.maxDuration = maxDuration;
        this.initGame();
    }

    initGame() {
        this.startAt = null;
        this.nbCardsFound = 0;
        this.$previousCard = null; // we use prefix $ for jQuery element
        this.timerId = null;
        this.isActiveGame = false;

        const $cards = $('.memory-board .memory-card');
        this.nbCards = $cards.length;
        // arrow function syntax
        $cards.click(($event) => this.selectCard($($event.target)));
    }

    startGame() {
        this.isActiveGame = true;
        this.startAt = new Date();
        // init timer, run a function every 1 sec
        // setInterval call the function after 1 sec
        // we want to start timer at the beginning, so we call timer() once before
        this.timer(this);
        this.timerId = setInterval(this.timer, 1000, this);
    }

    stopGame() {
        this.isActiveGame = false;
        clearInterval(this.timerId);
    }

    timer($this) {
        const duration = $this.getDuration();
        $this.updateDisplay(duration);

        // stop game if max duration is reached
        if (duration >= $this.maxDuration) {
            $this.stopGame();
            $this.notifFail();
        }
    }

    updateDisplay(timeElapse) {
        // we add a unit of time for the calculation, we want to begin the progress bar since the first second
        const progressWidth = Math.ceil((timeElapse + 1) * 100 / this.maxDuration);

        // update display
        $('.memory-game .progress-bar-inner').css('width', `${progressWidth}%`);
        $('.memory-game .time-elapse').html(`${timeElapse} secs`);
    }

    getDuration() {
        const now = new Date();

        return Math.round((now - this.startAt) / 1000);
    }

    notifFail() {
        Swal.fire({
            title: 'Temps écoulé',
            text: 'Tu feras mieux la prochaine fois !',
            showConfirmButton: false,
        });
    }

    notifSuccess(duration) {
        Swal.fire({
            title: `Bravo ! Tu as terminé en ${duration} secondes.`,
            input: 'text',
            showCancelButton: false,
            confirmButtonText: 'Envoyer mon score !',
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                // send post request after name selection
                const data = {'name': name, 'time': duration};
                $.post('/memory', data, function() {
                    // success request
                    Swal.fire({icon: 'success'});
                }).fail(function(data) {
                    // error request
                    Swal.fire({icon: 'error', text: data.responseJSON.error});
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    selectCard($card) {
        // do nothing if the game is not started (or lost)
        if (this.isActiveGame === false) {
            return;
        }

        // do nothing if the card is already displayed
        if ($card.hasClass('display-card')) {
            return;
        }

        this.displayCard($card);

        // if it's the first displayed card
        if (this.$previousCard === null) {
            this.$previousCard = $card;
            return;
        }

        // if the selected card is not the same as the previous one
        if (this.$previousCard.data('card') !== $card.data('card')) {
            this.hideSelectedCards(this.$previousCard, $card);
            return;
        }

        this.$previousCard = null;
        this.nbCardsFound += 2;

        // if we haven't found all cards, continue to play
        if (this.nbCardsFound < this.nbCards) {
            return;
        }

        this.stopGame();
        const duration = this.getDuration();
        this.notifSuccess(duration);

    }

    displayCard($card) {
        const position = $card.data('card') * 100;
        $card.css('background-position', '0 -' + position + 'px');
        $card.addClass('display-card');
    }

    hideSelectedCards($previousCard, $currentCard) {
        // remove immediately the selection to prevent clicks on other cards
        this.$previousCard = null;
        // wait a little before hide displayed cards
        setTimeout(function(){
            $previousCard.removeClass('display-card');
            $currentCard.removeClass('display-card');
        }, 500);
    }
}
