import { sectionFormLoginRegister } from './sectionFormLoginRegister.js';

document.addEventListener('DOMContentLoaded', () => {

    const current_page = window.location.pathname + window.location.search;
    const query_string = window.location.search;

    try {
        $.fn.dataTable.ext.errMode = 'none';
    } catch (error) {
        // Solo se controla para la página checkform
    }

    const loader = document.getElementById('initLoadingModal');

    // Función para mostrar/ocultar manualmente
    function loadLoader() {
        setTimeout(() => {
            $(loader).fadeOut();
        },1000);
    }
    
    const loadFunctionalities = (dispatch) => {
        const functions = {
            "sectionFormLoginRegister":() => sectionFormLoginRegister(),
        }
        
        // Se ejecuta la función que se corresponde con la página actual
        if (functions[dispatch]) {
            functions[dispatch]();
        } else {
            console.log(`Functionality for type "${dispatch}" not found.`);
        }

    }

    if ( current_page.includes('login') ) {
        loadFunctionalities("sectionFormLoginRegister");
    }

})