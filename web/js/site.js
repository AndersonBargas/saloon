jQuery(function ($) {
    var elem = document.querySelectorAll('.js-switch');
    elem.forEach(
        function (el, i) {
            new Switchery(el);
        }); 
});
