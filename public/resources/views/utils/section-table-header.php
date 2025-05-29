<?php
$tableData = parse_json(get_headers_table_data());
$headerTypes = [
    'header' => [
        'data' => $tableData->headers,
        'prefix' => 'field'
    ],
    'detailField' => [
        'data' => $tableData->detailFields,
        'prefix' => 'fielddetails',
        'hidden' => true
    ]
];

foreach ($headerTypes as $type => $config) {
    foreach ($config['data'] as $key => $value) {
        $hidden = isset($config['hidden']) ? ' hidden' : '';
        echo sprintf(
            '<th%s data-type="%s" data-%s-key="%s" data-%s-value="%s">%s</th>',
            $hidden,
            $type,
            $config['prefix'],
            $key,
            $config['prefix'],
            $value,
            $value
        );
    }
}
?>