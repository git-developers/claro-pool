(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formSolicitarCarrera = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var modalMsgDiv = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor ';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formSolicitarCarrera', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_id);
            modalMsgDiv = modal.find('div#message');
        };

        base.openModal = function(event, context) {
            // debug(e);

            modalMsgDiv.hide();
            var id = $(context).parent().parent().data('id');

            console.log("POLLO:: " + id);

            window.location.href = options.route_form + "solicitar-carrera/" + id;


            // $('.' + options.form_input_id).val(id);
            // var modalLabel = modal.find('small.label');
            // modalLabel.html('Item ' + id);
        };

        base.delete = function(event) {
            event.preventDefault();

            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_name + "']").serializeArray();


        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formSolicitarCarrera.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formSolicitarCarrera = function(options){

        return this.each(function(){

            var bp = new $.formSolicitarCarrera(this, options);

            $(document).on('click', 'button.' + options.modal_id, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.form_name + "']" , function(event) {
                bp.delete(event);
            });

        });

    };

})(jQuery);