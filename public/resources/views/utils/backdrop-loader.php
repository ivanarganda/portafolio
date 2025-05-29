<style>
/* Backdrop */
#initLoadingModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    /* Fondo blanco con opacidad */
    z-index: 1050;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
    transition: display 0.3s ease-in-out;
}

#initLoadingModal::after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1);
}

/* Animación para ocultar */
.hide-loader {
    opacity: 0;
    pointer-events: none;
}

/* Tamaño del spinner */
.spinner-border {
    width: 4rem;
    height: 4rem;
    border-width: 5px;
}
</style>
<div id="initLoadingModal">
    <div class="spinner-border text-primary" role="status"></div>
</div>