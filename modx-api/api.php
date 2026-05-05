<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('MODX_API_MODE', true);

// подключаем гл файл модХ
require_once dirname(__FILE__) . '/../index.php';

// токен для подключения
//$secretToken = 'JOPA_S_USHAMI';
//
//if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer' . $secretToken) {
//    http_response_code(401);
//
//    echo json_encode(['error' => 'Unauthorized']);
//    exit();
//}

$action = $_GET['action'] ?? '';

function get_structure() {

    global $modx;
    $result = [];

    $resource = $modx->getCollection('msCategory', [
        'class_key' => 'msCategory',
        'published' => 1,
    ]);

    foreach ($resource as $cat) {
        $result[] = [
            'id' => $cat->get('id'),
            'pagetitle' => $cat->get('pagetitle'),
            'url' => $modx->makeUrl($cat->get('id'), '', '', 'full'),
            'parent' => $cat->get('parent')
        ];
    }

    return json_encode($result, JSON_UNESCAPED_UNICODE);
}

header('Content-Type: application/json; charset=UTF-8');

if ($action === 'get_structure') {
    if (ob_get_length()) ob_clean();

    echo get_structure();
    exit();
}

if ($action === 'get_page') {
    $id = (int)$_GET['id'];

    $resource = $modx->getObject('modResource', $id);

    if (!$resource) {
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
    }

}
