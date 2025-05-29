<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnocasa Herramientas - Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div style="position:relative" class="container">
        <div id="wellcome_header_links">
            <div class="text-center mb-5">
                <img src="../../assets/img/logo.png" alt="Logo de Tecnocasa" class="img-fluid mb-4"
                    style="max-width: 100px;">
                <h1 class="display-4 text-center">Bienvenido a tus herramientas de zona de Tecnocasa</h1>
                <p class="lead m-auto">Tu suite integral de herramientas para la gestión de zona</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mis pedidos</h5>
                            <p class="card-text">Administra tus listados de propiedades, haz seguimiento a las visitas y
                                gestiona las interacciones con clientes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mis telefonos de zona</h5>
                            <p class="card-text">Accede a la información de los clientes que hayas registrado para
                                llamarlos si no los has localizado en tu zona cara a cara.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mis buzones</h5>
                            <p class="card-text">Accede a cada uno de los buzones con los nombres de los propietarios,
                                inquilinos, etc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="phone-listing" style="height:100vh;overflow:hidden;display:none" class="container py-5">
            <?php require_once 'abc-telefonos.php'; ?>
        </div>

        <div id="phone-listing" style="height:100vh;overflow:hidden;display:none" class="container py-5">
            <?php require_once 'phone-listing.php'; ?>
        </div>
    </div>

    <!-- Make a scroll navigation according links above -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // push history state to make a scroll navigation
    // document.getElementById('next_section_get_started').addEventListener('click', function(event) {
    //     event.preventDefault();
    //     history.pushState({}, 'Tecnocasa Herramientas', '/get-started');
    // });
    </script>
</body>

</html>