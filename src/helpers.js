import regexes_validation_form from './json/regexes_validation_form.js';
/**
 * Returns the current full hostname URL including protocol
 * @returns {string} The complete hostname URL (e.g., 'https://example.com')
 */
export const getFullHostname = () => {
    const protocol = window.location.protocol;
    const hostname = window.location.hostname;
    const port = window.location.port;
    
    return `${protocol}//${hostname}${port ? ':' + port : ''}`;
};

export const getCurrentDate = () => {
    return new Date().toISOString().split('T')[0];
};

/**
 * Set animation fade in and out
 */
export const fadeAnimation = ( element ) => {
    if (element.is(':visible')) {
        element.animate({
            height: 0,
            opacity: 0,
            paddingTop: 0,
            paddingBottom: 0
        }, 500, function() {
            $(this).hide();
        });
    } else {
        element.show().css({opacity: 0, height: 0, paddingTop: 0, paddingBottom: 0}).animate({
            height: element.get(0).scrollHeight,
            opacity: 1,
            paddingTop: '1rem',
            paddingBottom: '1rem'
        }, 500, function() {
            $(this).css('height', 'auto');
        });
    }
}

export const API_ENDPOINTS = {
    listing_telefonico: {
        total_rows: `${getFullHostname()}/api/client/clients.php?rows`,
        get: `${getFullHostname()}/api/client/clients.php`,
        delete: `${getFullHostname()}/api/client/delete.php`,
        register: `${getFullHostname()}/api/client/register.php`,
        update: `${getFullHostname()}/api/client/update.php`
    }
}

export const initIcons = ()=>{
    let defaultLoader = `<div class="spinner-border text-light" role="status">
                                </div>`;
    let defaultSuccessIcon = `<i style="font-size:80px" class="bi bi-check-circle text-success"></i>`;
    let defaultErrorIcon = `<i style="font-size:80px" class="bi bi-x text-danger"></i>`;
    return [
        defaultLoader , defaultSuccessIcon , defaultErrorIcon
    ];
}

export const setOverlayIcon = ( overlay , icon , options = {
hidden: false,
headers: false 
} 
)=>{

    let icons = initIcons();

    if ( icon === 'loader' ){
        overlay.classList.remove('d-none'); // Mostrar loader
        overlay.classList.add('d-flex'); // Mostrar loader
        return;
    }

    if ( !icons.includes(icon) ) {
        console.log('Not exist icon');
        return;
    }

    if ( typeof options === 'string' ) {
        console.log(`Options must be object following format: {
                hidden: false | true,
                headers: previous sibling of overlay    
            }`);
        return;
    }

    if ( options?.headers !== false && !overlay.innerHTML.includes(icon) ){
        $(`${options?.headers}`).css({ 'display':'flex', 'justify-content':'center', 'align-items':'center'}).append(icon);
        $(`${options?.headers} i`).css({ 'font-size':'28px' , 'padding-right':'5px'});
    }

    overlay.innerHTML = `${icon}`;

    if ( options?.hidden ){
        setTimeout(()=>{
            overlay.classList.remove('d-flex'); // Mostrar loader
            overlay.classList.add('d-none'); // Mostrar loader
        },options?.hidden);
    }
    
    return true;
}

export const initFilters = ( type )=>{
    let types = {
        'listing': {
            name: '',
            lastname: '',
            age: '',
            gender: '',
            phone: '',
            municipe: '',
            localize: '',
            street_type: '',
            street_name: '',
            street_number: '',
            postal_code: ''
        }
    };

    let filters = {
        search: '',
        pagination: {
            per_page: 10,
            current_page: 1
        }
    };

    if (types[type] === undefined) return false;

    filters = { [type]: types[type] , ...filters };

    return filters;
}

export const initElements = async()=>{

    const $submenu = $('#submenu');
    const $submenu_state_rows_selected = $('#submenu_state_rows_selected'); 
    const data_value_select = 'data-value="select"';
    const data_value_unselect = 'data-value="unselect"';

    const submenu = {
        dom: $submenu,
        id: '#submenu',
        data_values: {
            select:data_value_select,
            unselect:data_value_unselect
        }
    };
    const submenu_state_rows_selected = {
        dom: $submenu_state_rows_selected,
        id: '#submenu_state_rows_selected',
        data: {
            current_rows_selected: $('#submenu_state_rows_selected__current_rows_selected'),
            total_rows_selected: $('#submenu_state_rows_selected__total_rows_selected'),
        },
        buttons: {
            quit_all: $('#submenu_state_rows_selected__btn_quit_selected'),
            edit_all: $('#submenu_state_rows_selected__btn_edit'),
            delete_all: $('#submenu_state_rows_selected__btn_delete'),
        }
    };
    return [ submenu , submenu_state_rows_selected ];
} 

export const REGEXES = regexes_validation_form;

export const REGEX_INPUT_MAP = Object.entries(REGEXES).flatMap(([type, { pattern, inputs , format }]) =>
    inputs.map(key => ({
        key,
        type,
        pattern,
        format
    }))
);

export const outboxMessage = ()=>{
    return `<img src="../../assets/img/outbox.png" class="img-fluid w-25" style="height:auto" alt="Outbox">`;
}

/**
 * Set animation slide in and out
 *
 * 
    */
export const isDesktop = () => {
    return window.outerWidth > 768 && window.innerWidth > 768;
}

export const getTotalRowsTable = async( url )=>{
    if ( !url.includes('?') ) return 0;
    if ( !url.split('?')[1].includes('rows') ) return 0; // Si no se encuentra el parametro rows o no se incluye
    if ( url.split('?').length > 2 ) return 0; // Si hay mas de una ? en la url
    return await request(
        url,
        'POST',
        {},
        {},
        'json'
    );
}

// Agregar Bootstrap CDN si no está presente
// Función para agregar el CDN de Bootstrap si no está presente
const addBootstrapCDN = () => {
    return new Promise((resolve, reject) => {
        let bootstrapLoaded = false;

        // Verificar si Bootstrap ya está cargado
        if (window.bootstrap) {
            resolve();
            return;
        }

        // Agregar el CSS de Bootstrap si no está presente
        if (!document.querySelector('link[href*="bootstrap.min.css"]')) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
            document.head.appendChild(link);
        }

        // Agregar el JS de Bootstrap si no está presente
        if (!document.querySelector('script[src*="bootstrap.bundle.min.js"]')) {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
            script.defer = true;
            document.body.appendChild(script);

            // Esperar a que se cargue el script de Bootstrap
            script.onload = () => {
                bootstrapLoaded = true;
                resolve();
            };

            script.onerror = () => reject(new Error("Error al cargar Bootstrap"));
        } else {
            resolve();
        }
    });
};

// Función para crear el modal
export const createModal = async (type, title, message , defaultButton = true) => {
    try {
        await addBootstrapCDN();

        // Eliminar modal o backdrop previos
        const existingBackdrop = document.querySelector('.modal-backdrop');
        if (existingBackdrop) existingBackdrop.remove();

        const existingModal = document.querySelector('.modal');
        if (existingModal) existingModal.remove();

        // Crear contenedor del modal
        const modal = document.createElement('div');
        modal.classList.add('modal', 'fade');
        modal.id = 'messageModal';
        modal.tabIndex = -1;
        modal.setAttribute('aria-labelledby', 'messageModalLabel');
        modal.setAttribute('aria-hidden', 'true');

        // HTML completo según tipo
        if (type !== 'loader') {
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="messageModalLabel">${title}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ${message}
                        </div>

                        ${
                            defaultButton ? `<div class="modal-footer">
                                <button type="button" id="btn_ok" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                            </div>` : ''
                        }
                    </div>
                </div>
            `;
        } else {
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content d-flex align-items-center justify-content-center p-4">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">${message}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        document.body.appendChild(modal);

        // Inicializar y mostrar modal correctamente
        const modalElement = document.getElementById('messageModal');
        const bootstrapModal = new bootstrap.Modal(modalElement);
        bootstrapModal.show();

        // Eliminar del DOM al cerrarse
        modalElement.addEventListener('hidden.bs.modal', () => modalElement.remove());

        return bootstrapModal;
    } catch (error) {
        console.error("Error al crear el modal:", error);
    }
};

export const generateConfirmTemplate = (title, message, type= 'default' ) => {

    let labelsButton = {
        'default': `<button id="btn_ok" class="btn-sm" style="padding: 4px 8px; background:rgb(117, 117, 117); color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Confirmar
                </button>`,
        'delete': `<button id="btn_ok" class="btn-sm" style="padding: 4px 8px; background: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Eliminar
                </button>`,
        'update': `<button id="btn_ok" class="btn-sm" style="padding: 4px 8px; background:rgb(37, 155, 14); color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Editar
                </button>`
    }

    return `<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                <div>
                    <p style="margin: 5px 0 0;">${title}</p>
                </div>
            </div>
            <ul style="margin: 10px 0 15px 25px; padding: 0; list-style: none;">${message}</ul>
            <p style="color: #b02a37; font-weight: bold; margin-bottom: 20px;">⚠ Esta acción no se puede deshacer.</p>
            <div style="text-align: right;">
                <button data-bs-dismiss="modal" class="btn-sm" style="margin-right: 10px; padding: 4px 8px; background: #6c757d; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Cancelar
                </button>
                ${labelsButton[type] || labelsButton['default']}
            </div>`
}

export const check_selected_rows_submenu_state_rows = ( selected_rows , objectSubmenuStateRowsSelected ) =>{
    objectSubmenuStateRowsSelected.data.current_rows_selected.html( selected_rows.length );
}

export const map_checkedCheckboxes = (selected_rows,table) => {
    const checkboxes = table.find('#main_row input[type="checkbox"]');
    checkboxes.each(function(e) {
        const checkboxValue = this.value;
        if (selected_rows.includes(checkboxValue)) {
            this.checked = true;
            this.parentElement.parentElement.style.backgroundColor = '#e9ecef';
        } else {
            this.checked = false;
            this.parentElement.parentElement.style.backgroundColor = '#fff';
        }
    });
}

export const hideOrSeekSubmenuStateRowsSelected = (selected_rows, objectSubmenuStateRowsSelected) => {

    let classDNone = isDesktop() ? 'd-md-none' : 'd-none';
    let classDFlex = isDesktop() ? 'd-md-flex' : 'd-flex';

    if ( selected_rows.length > 0 ){ 
        objectSubmenuStateRowsSelected.dom.removeClass(classDNone).addClass(classDFlex);                     
    } else {
        objectSubmenuStateRowsSelected.dom.addClass(classDNone).removeClass(classDFlex); 
    }
}

export const labelsFormData = {
    'listing': [
        { name:`rc_id` , key: 'id' , label: '' },
        { name:`rc_name` , key: 'nombre' , label: 'Nombre' },
        { name:`rc_lastname` , key: 'apellidos' , label: 'Apellidos' },
        { name:`rc_age` , key: 'edad' , label: 'Edad' },
        { name:`rc_gender` , key: 'sexo' , label: 'Sexo' },
        { name:`rc_phone` , key: 'telefono' , label: 'Teléfono' },
        { name:`rc_municipe` , key: 'municipio' , label: 'Municipio' },
        { name:`rc_localize` , key: 'localidad' , label: 'Localidad' },
        { name:`rc_street_type` , key: 'tipo_via' , label: 'Tipo vía' },
        { name:`rc_street_name` , key: 'nombre_via' , label: 'Nombre vía' },
        { name:`rc_street_number` , key: 'numero_via' , label: 'Número vía' },
        { name:`rc_postal_code` , key: 'cp' , label: 'Código postal' }
    ],
    'login': [
        { name:`username` , key: 'username' , label: 'usuario' },
        { name:`password` , key: 'password' , label: 'contraseña' }
    ],
    'register': [
        { name:`username` , key: 'username' , label: 'usuario' },
        { name:`birth_date` , key: 'birth_date' , label: 'fecha nacimiento' },
        { name:`username` , key: 'username' , label: 'usuario' },
        { name:`gender` , key: 'sexo' , label: 'Sexo' }
    ]
};

export const initLabelsFormData = ( type )=>{  
    if ( labelsFormData[type] === undefined ) return false;
    return labelsFormData[type];
}

export const initRowsTable = async( type )=>{

    let headers =$(document).find(`table[table-type="${type}"] thead tr th[data-type="header"]`);
    let detailFields = $(document).find(`table[table-type="${type}"] thead tr th[data-type="detailField"]`);

    let rowsTable = {};

    rowsTable = {
        [type]:{
            'headers':[],
            'detailFields':[]
        },
        ...rowsTable
    };
    
    headers.each(function() {
        let fieldKey = $(this).data('field-key');
        let fieldValue = $(this).data('field-value');
        rowsTable[type].headers.push({ key: fieldKey, label: fieldValue });
    });

    detailFields.each(function() {
        let fieldKey = $(this).data('fielddetails-key');
        let fieldValue = $(this).data('fielddetails-value');
        rowsTable[type].detailFields.push({ key: fieldKey, label: fieldValue });
    });

    if ( rowsTable[type] === undefined ) return false;
    return [ rowsTable[type].headers , rowsTable[type].detailFields ];
}

export const formToJSON = ($form)=>{
    const unindexedArray = $form.serializeArray();
    const indexedArray = {};

    $.map(unindexedArray, function(n, i){
        indexedArray[n['name']] = n['value'];
    });

    return indexedArray;
}

export const validateFieldsForm = async( formData , type , options = { mode:'default', optionalFields:['id'] })=>{  

    let labels = initLabelsFormData(type);

    let errors = [];

    let { mode , optionalFields } = options;

    const modeValues = [ 'default' , 'basic' , 'strict' ];
    const defaultFormatFormData = `[{ key: value, .... }]`;
    const defaultFormatOptions = `{
        mode: ${modeValues.join('|')} :String,
        optionalFields: ['id'] :Array
    }`;

    // Validate and testing parameters
    // Validate first parameter: form data
    if ( !formData || formData === null || typeof formData !== 'object' ){
        console.error(`Expected not empty at first parameter as array or object entries form data. Must following format: ${defaultFormatFormData}`);
        return;
    }

    if ( Object.keys(formData).length === 0 ){
        console.error(`Expected not empty at first parameter as array or object entries form data. Must following format: ${defaultFormatFormData}`);
        return;
    }

    // Validate second parameter: type
    if ( !REGEXES.string.pattern.test(type) ){
        console.error(`Expected a string at second parameter as type`);
        return;
    }

    if ( !labels ){
        console.error(`Not matches and exists type form data as ${type}. Following types ara just like that: ${Object.keys(labelsFormData)}`);
        return;
    }

    /* Validate by optional third parameter: options which is an object that contains two properties: 
        {
            mode: as string ( default value "default" )
            optionalFields: as array ( allways with "id" element )
        }
    */

    if ( Array.isArray(options) && typeof options !== 'object' ){
        console.error(`Expected options as an object. Must following format: ${defaultFormatOptions}`);
        return; 
    }

    if ( !Object.keys(options).includes('mode') || !Object.keys(options).includes('optionalFields') ){
        console.error(`Expected options following keys as an object: ${defaultFormatOptions}`);
        return
    }

    if ( Object.keys(options).includes('mode') && Object.keys(options).includes('optionalFields') && Object.keys(options).length > 2 ){
        console.error(`Expected only 2 properties options following keys as an object: ${defaultFormatOptions}`);
        return 
    }

    if ( !REGEXES.string.pattern.test(mode) ){
        console.error(`Expected property mode as string at object options`);
        return;
    }

    if ( !modeValues.includes(mode) ){
        console.error(`Expected mode values: ${modeValues.join('|')}`);
        return;
    }
    
    if ( !Array.isArray(optionalFields) ){
        console.error(`Expected property optionalFields as array at object options`);
        return;
    }

    if ( Array.isArray(optionalFields) && !optionalFields.includes('id') ){
        console.error(`Once set options parameter, not missing element id in array`);
        return;
    }

    if ( Array.isArray(optionalFields) && optionalFields.length === 0 ){
        optionalFields = ['id'];
    }

    labels.forEach(label => {

        if ( optionalFields.includes(label.key) ) return;

        // Skip fields validaion
        let error = false;
        let regexEntry = REGEX_INPUT_MAP.find(regex => regex.key === label.key );     
        
        const value = formData[label.name] || '';

        let defaultKeysErrors = {
            error_label: label.label,
            error_key: label.key,
            error_name: label.name,
            error_input_value: value,
            error_format: regexEntry?.format,
        }

        // Validación: campo vacío
        if (value === '') {
            error = true;
            errors = [{
                ...defaultKeysErrors,
                error_type: 'empty'
            }, ...errors];
        }

        // Validación: patrón no coincide
        else if ( regexEntry?.pattern && !regexEntry.pattern.test(value)) {
            error = true;
            errors = [{
                ...defaultKeysErrors,
                error_type: 'format'
            }, ...errors];

        } else if ( label.key === 'birth_date' || label.key === 'datetime' || label.key === 'date' ){
            if ( formData[label.name] > getCurrentDate() ){
                error = true;
                errors = [{
                    ...defaultKeysErrors,
                    error_type: 'overcurrentdate'
                }, ...errors];
            }
        }

    });    
    
    if ( errors.length !== 0 ){

        let contentModalErrors = ``;
        let contentErrors = ``;

        let type_error = ``;

        errors.forEach(error => {

            if (error.error_type === 'format') type_error = `debe de tener el siguiente formato: "${error.error_format}"`;
            else if (error.error_type === 'empty') type_error = `No debe estar vacio`;
            else if (error.error_type === 'overcurrentdate') type_error = ` no debe excederse de la fecha de hoy`;

            contentErrors+=`<div class="d-flex align-items-center mb-2">
                            <span class="badge bg-danger me-3">!</span>
                            <div>
                                <p class="mb-0 text-muted small">El campo "${error.error_label}" ${type_error}</p>
                            </div>
                        </div>`;
        });

        contentModalErrors = `<div class="pb-4 pt-3">
                <p class="text-muted mb-4">Se encontraron los siguientes inconvenientes:</p> 
                <!-- Lista de Errores -->
                <div class="alert-list">
                    <!-- Ejemplo de error -->
                    <div class="alert-item bg-light p-3 mb-3 rounded shadow-sm">
                        ${contentErrors}
                    </div>
                </div>
            </div>`;

        await createModal('Error', 'Error', contentModalErrors);

        return false;
 
    }

    return true;
}

export const generateDynamicForm = async (labelsFormData, data, titleKeyFields = ['id']) => {

    let form = ``;

    let [ defaultLoader ] = initIcons();

    data.forEach((item, index) => {

        const titleString = titleKeyFields.map(key => item[key] || '').join(' ').trim();

        form += `<div class="accordion-item mb-2">
            <h2 class="accordion-header" id="heading${item.id}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${item.id}" aria-expanded="false" aria-controls="collapse${item.id}">
                    Registro #${item.id} - ${titleString}
                </button>
            </h2>
            <div id="collapse${item.id}" class="accordion-collapse collapse" aria-labelledby="heading${item.id}" data-bs-parent="#accordionEditGeneric">
                <div id="container_edit_forms" class="accordion-body position-relative">
                    <div class="form-overlay-loader d-none position-absolute top-0 start-0 w-100 h-100 bg-light bg-opacity-50 justify-content-center align-items-center" style="z-index: 10;">
                        ${defaultLoader}
                    </div>
                    <form class="row g-2 client-edit-form" data-client-id="${item.id}">
                        <input type="hidden" name="rc_id" value="${item.id}">
        `;

        labelsFormData.forEach(label => {

            if (label.name === 'rc_id' || label.name === 'id' ) return // ya está como hidden

            const value = item[label.key] ?? '';

            let inputField = '';

            if (label.name.includes('gender') || label.key === 'sexo') {
                inputField = `
                    <select name="${label.name}" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <option value="M" ${value === 'M' ? 'selected' : ''}>Hombre</option>
                        <option value="F" ${value === 'F' ? 'selected' : ''}>Mujer</option>
                    </select>`;

            } else {
                const inputType = label.name.includes('age') || label.name.includes('postal_code') || typeof value === 'number' ? 'number' : 'text';
                inputField = `
                    <input type="${inputType}" 
                           name="${label.name}" 
                           class="form-control form-control-sm" 
                           value="${value}">`;
            }

            form += `
                <div class="col-md-6">
                    <label class="form-label">${label.label}</label>
                    ${inputField}
                </div>`;
        });

        form += `
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary btn-sm me-2">Guardar</button>
                            <button type="reset" class="btn btn-outline-danger btn-sm">Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>`;
    });

    return form;
};

export const generateDynamicTable = async(headers, data, detailFields = []) => {

    const isDesktop = () => window.matchMedia('(min-width: 768px)').matches;

    let table = ``;

    if ( data.length === 0 ) {
        $('#btn_filters').hide();
        table+= isDesktop() ? 
        `<tr><td colspan="8" class="text-center"><picture class="text-center">${outboxMessage()}</picture></td></tr>` : 
        `<tr class="d-table-row d-md-none">
                    <td colspan="12" class="p-4">
                        <div id="main_row" class="row g-3">
                            <div class="col-12 col-sm-12">
                                <picture class="text-center">${outboxMessage()}</picture>
                            </div>
                        </div>
                    </td>
                </tr>`;
        return table;
    }

    data.forEach((row, index) => {

        let sizeStyleCheckbox = !isDesktop() ? ';font-size:28px;margin-top:-1px' : '';
        let dimensionsDetailsButton = !isDesktop() ? 'width=\"35\" height=\"35\"' : 'width=\"20\" height=\"20\"';
        const btn_details = `<img src=\"../../assets/img/plus.png\" id=\"btn_details_${index}\" ${dimensionsDetailsButton}  alt=\"Details\" class=\"rounded-circle\"/>`;
        const btn_checkbox = `<input type=\"checkbox\" style="cursor:pointer${sizeStyleCheckbox}" class=\"form-check-input\" id=\"checkbox_${index}\" value=\"${row.id}\" />`;
        
        if (isDesktop()) {

            table += `<tr style=\"cursor:pointer;\" data-value=\"${index}\" data-id=\"${row.id}\" id="main_row" class=\"row_${index} text-center\">`;
            headers.forEach(header => {
                if (header.key === 'actions') {
                    table += `<td>${btn_checkbox}&nbsp;&nbsp;${btn_details}</td>`;
                } else {
                    table += `<td>${row[header.key]}</td>`;
                }
            });
            table += `</tr>`;

            if (detailFields.length > 0) {
                table += `<tr class="details-row-${index}" style=\"display:none;\">
                    <td colspan=\"${headers.length}\" class=\"bg-light\">
                        <div class=\"row text-center g-2\">`;
                detailFields.forEach(field => {
                    table += `<div class=\"col-md-2 col-6\">
                        <div class=\"small text-muted\">${field.label}</div>
                        <div class=\"fw-medium\">${row[field.key]}</div>
                    </div>`;
                });
                table += `</div></td></tr>`;
            }

        } else {

            const btn_menu = `<i id=\"btn_menu_${index}\" data-value="btn_menu_${row.id}" class="bi bi-three-dots-vertical bg-light" style="padding:0.5rem;max-width:1rem;height:1rem;border-radius:50%"></i>`;

            table += `<tr data-value=\"${index}\" data-id=\"${row.id}\" id="main_row" class=\"row_${index} text-center\"><td colspan=\"${headers.length}\">`;
            table += `<div class=\"col-3 offset-9\">
                ${btn_menu}
            </div>`
            headers.forEach(header => {
                if (header.key !== 'actions') {
                    table += `<div class=\"col-6 offset-3\">
                        <div class=\"small text-muted\">${header.label}</div>
                        <div class=\"fw-medium\">${row[header.key]}</div>
                    </div>`;
                }
            });
            table += `<div class=\"col-12 d-flex justify-content-center align-items-center gap-3\">${btn_checkbox} ${btn_details}</div>`;

            if (detailFields.length > 0) {
                table += `<div class=\"details-row-${index} row g-3\" style=\"display:none;\">
                    <div class=\"col-12\"><hr class=\"my-2\"></div>`;
                detailFields.forEach(field => {
                    table += `<div class=\"col-6\">
                        <div class=\"small text-muted\">${field.label}</div>
                        <div class=\"fw-medium\">${row[field.key]}</div>
                    </div>`;
                });
                table += `</div>`;
            }

            table += `</td></tr>`;

        }

    });

    table += `</tbody></table>`;

    return table;
};


export const request = async( url , method, headers , data , type_response = 'json' ) =>{

    let response = false;

    try {

        if ( method === 'GET' || method === 'get' || method === '') {
            response = await fetch( url, {
                headers
            })
        }
        if ( method === 'POST' || method === 'post' || method === 'PUT' || method === 'put' || method === 'DELETE' || method === 'delete') {
            response = await fetch( url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers
            })
        }

        return new Promise( (resolve, reject) => {
            if (!response.ok) {
                reject( new Error(response.error));
            } else {
                if ( type_response === 'json' ) {
                    resolve(response.json());
                }
                if ( type_response === 'text' ) {
                    resolve(response.text());
                }
                if ( type_response === 'blob' ) {
                    resolve(response.blob());
                }
                if ( type_response === 'arrayBuffer' ) {
                    resolve(response.arrayBuffer());
                }
                if ( type_response === 'formData' ) {
                    resolve(response.formData());
                }
            }
        });
    
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}
export const generateSubmenu = (row, row_checkbox, selected_rows, objectSubmenu, hidden = false) => {
    const $row = $(row);
    const rect = row.getBoundingClientRect();

    if (isDesktop()){
        $(objectSubmenu.dom).css({
            'top': `${-100 + (rect.bottom + window.scrollY)}px`,
            'right': `${200 - window.scrollX}px`,
            'display': hidden ? 'none' : 'block'
        });
    } else {

        $(objectSubmenu.dom).css({
            'top': `${-400 + (rect.bottom + window.scrollY)}px`,
            'right': `${50 - window.scrollX}px`,
            'display': hidden ? 'none' : 'block'
        });
    }
    
    const id = $row.attr('data-id');
    $(objectSubmenu.dom).find('ul').attr('data-row-id', id);
    
    const $li = $(objectSubmenu.dom).find(`li[${objectSubmenu.data_values.select}]`,`li[${objectSubmenu.data_values.unselect}]`);

    if (selected_rows.includes(id) && $row.find(`${row_checkbox}`).is(':checked')) {
        $li.html(`<i ${objectSubmenu.data_values.unselect} class="bi bi-check2-square"></i> Deseleccionar`);
    } else {
        $li.html(`<i ${objectSubmenu.data_values.select} class="bi bi-square"></i> Seleccionar`);
    }
};

export const renderSectionTagFilters = async( filters ) => {
    let noFilters = true;
    for (const filter of Object.keys(filters.listing)) {
        if ( filters.listing[filter] !== '') {
            noFilters = false;
        }
    }
    
    if (noFilters) {
        document.querySelector('#tagFilters').innerHTML = 'No hay filtros aplicados';
    } else {
        let tags = '';
        tags+= `<span id="filtersRegistered" class="text-muted fs-6 mb-2">
            Filtros aplicados:
            </span>
            <div id="filtersTags" class="d-flex flex-wrap align-items-center justify-content-center gap-2">`;
        for (const filter of Object.keys(filters.listing)) {
            if (filters.listing[filter] === '') {
                continue;
            }
            tags+=`
            <span id="${filter}" class="badge bg-secondary rounded-pill py-2 px-3 shadow-sm">
                ${filter}: ${filters.listing[filter]}
            </span>`;
        }
        tags+=`</div>`;
        document.querySelector('#tagFilters').innerHTML = tags;
    }
}

// Use rendering and handing pagination
export const renderPagination = ( total_rows , current_page , per_page = 10 ) => {
    let pagination = ``;
    let pages = Math.ceil(total_rows / per_page);

    pagination+=`<ul class="pagination">`;
    for (let i = 0; i < pages; i++) {
        pagination += `<li style="cursor:pointer" id="${i+1}" class="page-item ${(i+1) == current_page ? 'active' : ''}"><a class="page-link" id="${i+1}">${i+1}</a></li>`;
    }
    pagination+=`</ul>`;
    document.querySelector("#pagination").innerHTML = pagination;
}