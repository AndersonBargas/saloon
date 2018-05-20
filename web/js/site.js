var calendario = null;

function calendarioToggle(ev) {
    ev.preventDefault();
    calendario.toggle();
}


jQuery(function ($) {

    moment.locale('pt-br');

    var elem = document.querySelectorAll('.js-switch');
    elem.forEach(
        function (el, i) {
            new Switchery(el);
        }
    );
    
    yii.allowAction = function ($e) {
        var message = $e.data('confirm');
        return message === undefined || yii.confirm(message, $e);
    };

    yii.confirm = function (message, ok, cancel) {
        bootbox.confirm({
    	    message: message,
    	    buttons: {
    	        confirm: {
                        label: 'Excluir!',
                        className: 'btn-danger'
                },
                cancel: {
                        label: 'Manter como está',
                        className: 'btn-success'
                }
    		},
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
    		}
    	});
    }

});
