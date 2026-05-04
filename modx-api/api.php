<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('MODX_API_MODE', true);

// подключаем гл файл модХ
require_once dirname(__FILE__) . '/../index.php';

//---Логирование
$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('FILE');

//---Доступ
$headers = getallheaders();
$headers = array_change_key_case($headers, CASE_LOWER);
$authHeader = $headers['authorization'] ?? '';

$secretToken = 'JOPA_S_USHAMI';

//if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer' . $secretToken) {
//    http_response_code(401);
//
//    echo json_encode(['error' => 'Unauthorized']);
//    exit();
//}

$action = $_GET['action'] ?? '';

if ($action === 'get_structure') {

//    $c = $modx->newQuery('msCategory');
//    $c = where([
//        'class_key' => 'msCategory'
//    ]);

    $resource = $modx->getCollection('msCategory', [
        'class_key' => 'msCategory',
        'published' => 1,
    ]);

    $result = [];

    foreach ($resource as $cat) {
        $result[] = [
            'id' => $cat->get('id'),
            'pagetitle' => $cat->get('pagetitle'),
            'parent' => $cat->get('parent')
        ];
    }

    return json_encode($result, JSON_UNESCAPED_UNICODE);
}

if ($action === 'get_page') {
    $id = (int)$_GET['id'];

    $resource = $modx->getObject('modResource', $id);

    if (!$resource) {
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
    } else {

    }

}
