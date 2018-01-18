// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $, window, document, undefined ) {
    var formRegister = {
		init: function(options, elem) {
			var self = this;
            self.elem = elem;
            self.$elem = $( elem );

            self.options = $.extend( {}, $.fn.formRegister.options, options );

            self.$tap = self.$elem.find('.js-change-step');

            self.$next = self.$elem.find('#btn-next');
            self.$back = self.$elem.find('#btn-back');
            self.$submit = self.$elem.find('.btn-submit');

            self.currTap = self.$elem.find(".js-current-step li a.active").data('target').substr(5); // get current state
            
            self.setElem();
            self.Events();
        
        },
        setElem: function(){
            var self = this;
            self.$elem.find('#form2').addClass('hidden_elem')
            self.$elem.find('#form3').addClass('hidden_elem')
            self.setButton( self.currTap );
            
        },
        Events: function(){
            var self = this;
            self.$tap.click(function(){
              const whereisgo = $(this).data("target").substr(5);   
              self.$tap.removeClass('active');
              $(this).addClass('active');
              self.$elem.find(".js-hidden-form").addClass("hidden_elem");
              self.$elem.find("#form"+whereisgo).removeClass("hidden_elem");

              self.setButton( whereisgo );
              if( whereisgo == 3 ){
                self.setPreview();
              }
            });

            self.$next.click(function(){
                if( self.currTap == 3 ){
                    return false;
                }
                else{
                    self.currTap = parseInt(self.currTap)+1;
                    self.setTap( self.currTap );
                    self.setButton( self.currTap );
                }
            });

            self.$back.click(function(){
                if( self.currTap == 1 ){
                    return false;
                }
                else{
                    self.currTap = parseInt(self.currTap)-1;
                    self.setTap( self.currTap );
                    self.setButton( self.currTap );
                }
            });
        },
        setTap: function( tap ){
            var self = this;
            
            self.$tap.removeClass('active');
            self.$tap.find('[data-target=#form'+tap+']').addClass('active');
            self.$elem.find(".js-hidden-form").addClass("hidden_elem");
            self.$elem.find("#form"+tap).removeClass("hidden_elem");
            self.setButton( tap );
        },
        setButton: function( tap ){
            var self = this;
            if( tap == 1 ){
                self.$back.addClass('hidden_elem');
                self.$next.removeClass('hidden_elem');
                self.$submit.addClass('hidden_elem');
            }
            else if( tap == 2 ){
                self.$back.removeClass('hidden_elem');
                self.$next.removeClass('hidden_elem');
                self.$submit.addClass('hidden_elem');
            }
            else if( tap == 3){
                self.$back.removeClass('hidden_elem');
                self.$next.addClass('hidden_elem');
                self.$submit.removeClass('hidden_elem');
            }
        },
        setPreview: function(){
            var self = this;
        }
    }
    $.fn.formRegister = function( options ) {
		return this.each(function() {
			var $this = Object.create( formRegister );
			$this.init( options, this );
			$.data( this, 'formRegister', $this );
		});
	};
	$.fn.formRegister.options = {
		scaledX: 640,
		scaledY: 360
	};
	
})( jQuery, window, document );