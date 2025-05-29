const regexes_validation_form = { 
    email: {
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        inputs: ['email', 'correo', 'correo_electronico', 'email_address'],
        format: 'usuario@ejemplo.com'
    },
    phone: {
        pattern: /^\d{8,15}$/, // ampliado a 15 dígitos para números internacionales
        inputs: ['telefono', 'phone', 'mobile', 'celular', 'telefono_movil'],
        format: '612345678'
    },
    password: {
        pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/, // acepta símbolos comunes
        inputs: ['password', 'contraseña', 'clave', 'contrasena', 'user_password'],
        format: 'abc12345'
    },
    string: { 
        pattern: /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ'-]+$/,
        inputs: ['nombre', 'apellidos', 'municipio', 'localidad', 'tipo_via', 'nombre_via', 'name', 'lastname', 'city', 'town', 'street_type', 'street_name'],
        format: 'Example'
    },
    number: {
        pattern: /^\d+$/,
        inputs: ['id','edad', 'cp', 'numero_via', 'zip', 'zipcode', 'postal_code', 'age', 'number'],
        format: '12345'
    },
    alphanumeric: {
        pattern: /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑüÜ.,_\-\/#]+$/,
        inputs: ['direccion', 'usuario', 'username', 'address', 'alias', 'user', 'fullname'],
        format: 'Calle Mayor 123'
    },
    dni_nie: {
        pattern: /^[XYZ]?\d{5,8}[A-Z]$/,
        inputs: ['dni', 'nie', 'documento_identidad', 'national_id'],
        format: '12345678Z'
    },
    rfc_mexico: {
        pattern: /^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/,
        inputs: ['rfc'],
        format: 'GODE561231GR8'
    },
    fecha: {
        pattern: /^\d{4}-\d{2}-\d{2}$/, // formato YYYY-MM-DD
        inputs: ['fecha', 'birth_date', 'date', 'fecha_nacimiento'],
        format: '1990-05-15'
    },
    time: {
        pattern: /^([01]\d|2[0-3]):([0-5]\d)$/, // formato HH:MM 24h
        inputs: ['hora', 'time'],
        format: '14:30'
    },
    url: {
        pattern: /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/,
        inputs: ['url', 'website', 'web'],
        format: 'https://www.ejemplo.com'
    }
};

export default regexes_validation_form;
