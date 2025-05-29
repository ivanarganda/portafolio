<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .submenu {
    position: absolute;
    display: none;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 12px rgba(0,0,0,0.15);
    border: 1px solid #e5e7eb;
    padding: 6px 0;
    min-width: 150px;
    z-index: 1000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transform-origin: top center;
    animation: fadeInScale 0.2s ease-in-out;
}

.submenu::before {
    content: "";
    position: absolute;
    top: -8px;
    left: 20px;
    border-width: 8px;
    border-style: solid;
    border-color: transparent transparent #ffffff transparent;
    filter: drop-shadow(0 -2px 2px rgba(0,0,0,0.05));
}

.submenu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.submenu ul li {
    padding: 8px 14px;
    cursor: pointer;
    transition: background-color 0.2s, color 0.2s;
    color: #374151;
}

.submenu ul li:hover {
    background-color: #f3f4f6;
    color: #111827;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

</style>