try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('datatables.net-bs4');
    require('sweetalert2');
} catch (e) {}
