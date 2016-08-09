jQuery(document).on('click', 'video', function(){
        if (this.paused) {
            this.play();
        } else {
            this.pause();
        }
});
