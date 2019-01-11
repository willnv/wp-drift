/**
 * Sticky menu para o tema WP-Drift
 * 
 * @author Willon Nava
 */
jQuery(function($) {

    var sticky_menu = {

        /**
         * Inicia as funções, variáveis e aplica 
         * os eventos.
         */
        init: function() {
            this.seletorMenu = $(".main-header");
            this.document = $(document);
            this.screenWidth = window.screen.width;

            this.stickyDesktop = this.stickyDesktop.bind( this );
    
            if (this.screenWidth > 1000) {
                this.document.on( 'scroll', this.stickyDesktop);
            } else {
                //this.document.on( 'scroll', this.stickyMobile);
            }
        },
    

        /**
         * Adiciona a classe sticky no header, quando
         * o a distancia para o topo for maior que
         * "distanciaAtivar"
         */
        stickyDesktop: function() {
            var distancia = this.document.scrollTop();
            var distanciaAtivar = 100;

            if (distancia > distanciaAtivar) {
                this.seletorMenu.addClass("sticky");
            } else {
                this.seletorMenu.removeClass("sticky");
            }
        },

        /**
         * A ser desenvolvido.
         */
        stickyMobile: function() {}
    }
    
    sticky_menu.init();

});
