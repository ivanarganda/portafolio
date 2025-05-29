<?php require_once 'utils/section-styles.php'; ?>

<div style="position:relative;min-height:80vh;display:flex;flex-direction:column" class="row mt-md-1">
    <?php require_once 'utils/section-header-buttons.php'; ?>
    <!-- Add Bootstrap 5 CSS -->
    <!-- Register client form -->
    <div id="container_form_register_client" style="display:none" class="row col-lg-12">
        <div class="col-lg-12 mb-4">
            <form id="registerClientForm" class="row g-3">
                <?php require_once 'utils/section-form-register.php'; ?>
            </form>
        </div>
    </div>
    <!-- Filters form -->
    <div id="container_form_filters" style="display:none" class="row col-lg-12">
        <div class="col-lg-12 mb-4">
            <form id="filterForm" class="row g-3">
                <div class="col-lg-2">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-sm" id="name" name="name">
                </div>
                <div class="col-lg-2">
                    <label for="lastname" class="form-label">Apellidos</label>
                    <input type="text" class="form-control form-control-sm" id="lastname" name="lastname">
                </div>
                <div class="col-lg-2">
                    <label for="age" class="form-label">Edad</label>
                    <input type="number" class="form-control form-control-sm" id="age" name="age">
                </div>
                <div class="col-lg-2">
                    <label for="gender" class="form-label">Sexo</label>
                    <select class="form-select form-select-sm" id="gender" name="gender">
                        <option value="">Todos</option>
                        <option value="M">Hombre</option>
                        <option value="F">Mujer</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                </div>
                <div class="col-lg-2">
                    <label for="municipe" class="form-label">Municipio</label>
                    <input type="text" class="form-control form-control-sm" id="municipe" name="municipe">
                </div>
                <div class="col-lg-2">
                    <label for="localize" class="form-label">Localidad</label>
                    <input type="text" class="form-control form-control-sm" id="localize" name="localize">
                </div>
                <div class="col-lg-2">
                    <label for="street_type" class="form-label">Tipo via</label>
                    <input type="text" class="form-control form-control-sm" id="street_type" name="street_type">
                </div>
                <div class="col-lg-2">
                    <label for="street_name" class="form-label">Nombre via</label>
                    <input type="text" class="form-control form-control-sm" id="street_name" name="street_name">
                </div>
                <div class="col-lg-2">
                    <label for="street_number" class="form-label">Numero de via</label>
                    <input type="text" class="form-control form-control-sm" id="street_number" name="street_number">
                </div>
                <div class="col-lg-2">
                    <label for="postal_code" class="form-label">Codigo postal</label>
                    <input type="number" class="form-control form-control-sm" id="postal_code" name="postal_code">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary btn-xs pl-1 pr-1 pt-1 pb-1">Filtrar</button>
                    <button type="reset" id="btn_delete_filters_phone_listing" class="btn btn-danger btn-sm pl-1 pr-1 pt-1 pb-1">Borrar</button>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div id="tagFilters" class="alert alert-primary d-flex flex-column align-items-center justify-content-center py-2 rounded shadow-sm" role="alert">
                No hay filtros registrados
            </div>
        </div>
    </div>

    <!-- Add Bootstrap 5 JS -->
    <div style="flex:1" class="col-md-12">
        <div class="table-responsive">
            <div class="table-responsive rounded-3 shadow-sm">
                <table id="phoneTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr class="d-none d-md-table-row text-center">
                            <th>&nbsp;</th>
                            <th>Id</th>
                            <th class="ps-4">Nombre</th>
                            <th>Apellidos</th>
                            <th>Edad</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="position:relative"></tr>
                    </tbody>
                </table>
                <?php require_once 'utils/submenu.php'; ?>
            </div>
            <div id="pagination" class="d-flex justify-content-center mt-3">
            </div>
        </div>
    </div>
    <!-- Submenu de opciones: x selecciados, seleccionar todos, eliminar y editar -->
    <?php require_once "utils/submenu-overlay-state-selected-rows.php"; ?>
</div>