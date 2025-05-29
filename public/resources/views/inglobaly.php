<style>
/* Contenedor principal centrado */
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f8f9fa;
    padding: 2rem;
}

/* Logo InGlobaly */
.logo {
    max-width: 250px;
    height: auto;
    margin: 1.5rem 0;
    transition: transform 0.3s ease;
    border: 2px solid transparent;
    padding: 5px;
}

.logo:hover {
    transform: scale(1.05);
    border-color:rgb(209, 209, 209);
}

/* Icono y notificación externa */
.external-alert {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: #fff3cd;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin: 1rem 0;
    border: 1px solid #ffeeba;
}

.external-icon {
    font-size: 1.2rem;
    color: #ffc107;
}

/* Texto de enlace externo */
.external-text {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    color: #17a2b8;
    font-weight: 600;
    margin: 0.5rem 0;
}

.external-text i {
    font-size: 0.8em;
}

/* Estilos de encabezado */
h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #343a40;
    text-align: center;
}

p {
    color: #6c757d;
    max-width: 600px;
    text-align: center;
    line-height: 1.6;
}

.external-link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>

<div class="container text-center">
    <div class="external-alert">
        <i class="fas fa-external-link-alt external-icon"></i>
        <span>Este enlace te llevará a un sitio web externo</span>
    </div>

    <a href="https://www.inglobaly.com/index.jsf" 
       target="_blank" 
       rel="noopener noreferrer"
       class="external-link"
       aria-label="Visitar InGlobaly (se abre en nueva pestaña)">
        
        <img src="../../assets/img/inglobaly.png" 
             alt="InGlobaly Logo" 
             class="logo"
             width="300">
        
        <span class="external-text">
            www.inglobaly.com
            <i class="fas fa-external-link-alt"></i>
        </span>
    </a>

    <p class="mt-3">Al hacer clic en el enlace, serás redirigido a un sitio web externo. Por favor revisa sus políticas de privacidad antes de continuar.</p>
</div>