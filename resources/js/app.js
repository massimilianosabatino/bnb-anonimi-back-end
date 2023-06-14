import './bootstrap';
import Alpine from 'alpinejs';
import '~resources/scss/app.scss';
import.meta.glob([
    '../img/**'
]);

import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;

Alpine.start();
