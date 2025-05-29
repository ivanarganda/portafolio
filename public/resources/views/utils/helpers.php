<?php 

function parse_json( $array ){
    return json_decode(json_encode( $array ));
}

function get( $key ){
    return $_GET[$key] ?? null;
}

function debug( $data ){
    var_dump($data);
}

function array_key_prev(array $arr, $currentKey) {
    $keys = array_keys($arr);
    $pos  = array_search($currentKey, $keys, true);
    if ($pos === false || $pos === 0) {
        return null;
    }
    return $keys[$pos - 1];
}

function object_prop_prev(stdClass $obj, $currentProp) {
    // cast the object to array (preserves property order)
    $arr  = (array) $obj;
    $keys = array_keys($arr);
    $pos  = array_search($currentProp, $keys, true);
    if ($pos === false || $pos === 0) {
        return null;
    }
    return $keys[$pos - 1];
}


function get_clients(){
    global $conexion;

    try {

        $id_usuario = $_SESSION['credentials']['id'];

        $sql = "SELECT c.id,c.nombre,c.apellidos FROM clientes c WHERE c.id_usuario = ? AND c.state = 1 AND c.id IS NOT NULL";

        $stm = $conexion->prepare($sql);
        $stm->bind_param('i', $id_usuario);
        $stm->execute();
        $result = $stm->get_result();

        $clients = $result->fetch_all(MYSQLI_ASSOC);

        if ( is_bool($clients) && !$clients ){
            return false;
        }
    
       // init mapped array
        $mappedClients = [];
    
        foreach ($clients as $key => $client) {
            // assume 'name' and 'id' always exist
            $mappedClients[ $client['id'] ] = $client['nombre'] . " " . $client['apellidos'];
        }

        return $mappedClients;

    } catch (Exception $e ){
        return false;
    }

}

function get_headers_table_data(){
    
    $headers = [ 
            'phone-listing' => [
                'headers' => [ 
                    'actions' => '&nbsp;',
                    'id' => 'Id',
                    'nombre' => 'Nombre',
                    'apellidos' => 'Apellidos',
                    'edad' => 'Edad',
                    'sexo' => 'Sexo',
                    'telefono' => 'Teléfono',
                    'nombre_via' => 'Dirección' 
                ],
               'detailFields' => [
                    'tipo_via' => 'Tipo de vía',
                    'numero_via' => 'Número de via',
                    'resto_via' => 'Resto de via',
                    'cp' => 'Código postal',
                    'municipio' => 'Municipio',
                    'localidad' => 'Localidad'
                ]
            ]
    ];
    
    return $headers[get('page')];
}

function get_form_data_section(){

    $dataForm = [
        'phone-listing' => [
            'register' => [
                'form_labels' => 
                [
                    'rc_name' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Nombre'
                    ],
                    'rc_lastname' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Apellidos'
                    ],
                    'rc_age' => [
                        'field_type' => 'input',
                        'field_atribute' => 'number',
                        'field_label' => 'Edad'
                    ],
                    'rc_gender' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            'Hombre' => 'M',
                            'Mujer' => 'F'
                        ],
                        'field_label' => 'Sexo'
                    ],
                    'rc_phone' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Telefono'
                    ],
                    'rc_municipe' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Municipio'
                    ],
                    'rc_localize' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Localidad'
                    ],
                    'rc_street_type' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Tipo via'
                    ],
                    'rc_street_name' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Nombre via'
                    ],
                    'rc_street_number' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Numero de via'
                    ],
                    'rc_postal_code' => [
                        'field_type' => 'input',
                        'field_atribute' => 'number',
                        'field_label' => 'Codigo postal'
                    ]
                ],
                'form_buttons' => [
                    'submit' => [ 
                        'styleClass' => 'btn btn-primary btn-xs pl-1 pr-1 pt-1 pb-1',
                        'label' => 'Registrar',
                        'id' => ''
                    ],
                    'reset' => [ 
                        'styleClass' => 'btn btn-danger btn-sm pl-1 pr-1 pt-1 pb-1',
                        'label' => 'Borrar',
                        'id' => 'btn_delete_fields_register_client'
                    ]
                ]
            ],
            'filters' => [

            ]   
        ],
        'order-listing' => [
            'register' => [
                'form_labels' => 
                [
                    'ro_clients' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            
                        ],
                        'field_label' => 'Clientes'
                    ],
                    'ro_interes' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            'Compra' => 'comprar',
                            'Venta' => 'vender',
                            'Alquiler' => 'alquilar'
                        ],
                        'field_label' => 'Interes'
                    ],
                    'ro_estudio_financiero' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            'Si' => 1,
                            'No' => 0
                        ],
                        'field_label' => 'Estudio financiero'
                    ],
                    'rc_price' => [
                        'field_type' => 'input',
                        'field_atribute' => 'text',
                        'field_label' => 'Precio'
                    ],
                    'rc_especifications' => [
                        'field_type' => 'textarea',
                        'field_atribute' => 'text',
                        'field_label' => 'Especificaciones'
                    ],
                    'rc_call_status' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            'Pendiente' => 'P',
                            'Realizado' => 'R',
                            'Colgado' => 'D'
                        ],
                        'field_label' => 'Estado llamada'
                    ],
                    'rc_order_state' => [
                        'field_type' => 'select',
                        'field_atribute' => '',
                        'field_values_select' => [
                            'Todos' => '',
                            'Abierto' => 'O',
                            'Cerrado' => 'C'
                        ],
                        'field_label' => 'Estado pedido'
                    ],
                    'rc_observations' => [
                        'field_type' => 'textarea',
                        'field_atribute' => 'text',
                        'field_label' => 'Observaciones'
                    ],
                    
                ],
                'form_buttons' => [
                    'submit' => [ 
                        'styleClass' => 'btn btn-primary btn-xs pl-1 pr-1 pt-1 pb-1',
                        'label' => 'Registrar',
                        'id' => ''
                    ],
                    'reset' => [ 
                        'styleClass' => 'btn btn-danger btn-sm pl-1 pr-1 pt-1 pb-1',
                        'label' => 'Borrar',
                        'id' => 'btn_delete_fields_register_order'
                    ]
                ]
            ],
            'filters' => [

            ]
        ]
    ];

    if ( get('page') === 'order-listing' ){
        $clients = get_clients();
        if ( $clients ){
            foreach ( $clients as $key => $client ){
                $dataForm['order-listing']['register']['form_labels']['ro_clients']['field_values_select'][$key] = $client;
            }
        }
    } 
    
    return $dataForm;
    
}


?>