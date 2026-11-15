<?php
function escapar($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function precioNumerico($precio) {
    return (int)str_replace(['$', ','], '', $precio);
}
function opciones($registros, $campo) {
    $valores = array_unique(array_column($registros, $campo));
    sort($valores, SORT_NATURAL | SORT_FLAG_CASE);
    return $valores;
}
$registros = json_decode(file_get_contents(__DIR__ . '/data-1.json'), true);
if (!is_array($registros)) {
    http_response_code(500);
    exit('No se pudo leer el catálogo.');
}
$ciudad = $_GET['ciudad'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$todos = isset($_GET['todos']);
$busqueda = isset($_GET['precio']) || $todos;
$maximo = max(100000, ...array_map('precioNumerico', array_column($registros, 'Precio')));
$desde = 200;
$hasta = 80000;
$rango = $_GET['precio'] ?? '';
$valido = is_string($rango) && preg_match('/^([0-9]+);([0-9]+)$/D', $rango, $limites);
if ($valido) {
    $desde = (int)$limites[1];
    $hasta = (int)$limites[2];
    $valido = $desde <= $hasta && $hasta <= $maximo;
}
$resultados = [];
if ($todos) {
    $resultados = $registros;
} elseif ($busqueda && $valido) {
    foreach ($registros as $registro) {
        $precio = precioNumerico($registro['Precio']);
        if (($ciudad === '' || $ciudad === $registro['Ciudad'])
            && ($tipo === '' || $tipo === $registro['Tipo'])
            && $precio >= $desde && $precio <= $hasta) {
            $resultados[] = $registro;
        }
    }
}
