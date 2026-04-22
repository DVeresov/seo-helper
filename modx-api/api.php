<?php

define('MODX_API_MODE', true);

// подключаем гл файл модХ
require_once dirname(__FILE__) . '/index.php';

//---Логирование
$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('FILE');

//---Доступ
$headers = getallheaders();

$secretToken = 'JOPA_S_USHAMI';

if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer' . $secretToken) {
    http_response_code(401);

    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$action = $_GET['action'] ?? '';

if ($action === 'get_structure') {

    $c = where([
        'class_key' => 'msCategory'
    ]);

    $resource = $modx->getCollection('msCategory', $c);

    $result = [];

    foreach ($resource as $cat) {
        $result[] = [
            'id' => $cat->get('id'),
            'pagetitle' => $cat->get('pagetitle'),
            'parent' => $cat->get('parent')
        ];
    }

    return json_encode($result);
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
