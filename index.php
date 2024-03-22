<?php

require_once("./vendor/autoload.php");

use App\Controller\CustomerController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

$customerController = new CustomerController();

switch ($method) {
    case "GET":
        if ($uri == "/") {
            $customerController->index();
            return;
        }
        $id = explode("/", $uri)[1];
        $customerController->show($id);
        break;

    case "POST":
        $customerController->store();
        break;

    case "PUT":
        $id = explode("/", $uri)[1];
        $customerController->update($id);
        break;

    case "DELETE":
        $id = explode("/", $uri)[1];
        $customerController->destroy($id);
        break;

    default:
        $status = 405;
        http_response_code($status);
        echo json_encode(["error" => [
            "message" => "Method not allowed",
            "status" => $status
        ]]);
        break;
}
