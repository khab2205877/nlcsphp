<?php

define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();

try {
  $PDO = (new App\Models\PDOFactory())->create([
    'dbhost' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'dbuser' => $_ENV['DB_USER'],
    'dbpass' => $_ENV['DB_PASS'],
  ]);
} catch (Exception $ex) {
  die('Không thể kết nối đến MySQL. Vui lòng kiểm tra lại thông tin kết nối.<br>' . $ex->getMessage());
}

$AUTHGUARD = new App\SessionGuard();
