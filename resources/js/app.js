import "./bootstrap";
import Alpine from "alpinejs";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);

import * as bootstrap from "bootstrap";

window.Alpine = Alpine;

Alpine.start();


import "../js/login";

// Timer che mostra il messaggio di conferma per 6 secondi
if(document.getElementById('message')){
    window.addEventListener('load',function(){
    let message = document.getElementById('message');
    this.setInterval(function(){
        message.classList.add('hidden');
    },5000)
})
}

const selectImage = document.querySelector('.select_img')
// Anteprima Immagine 
selectImage.onchange = evt => {
    let preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}