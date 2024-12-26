<?php

namespace app\Routes;

include "app/Controller/ProductController.php";

use app\Controller\ProductController;

class ProductRoutes
{
    public function handle($method, $path)
    {
        $controller = new ProductController();

        if ($method == "GET" && $path == '/api/product') {
            echo $controller->index();
        } elseif ($method == "GET" && str_contains($path, "/api/product/")) {
            $name = basename($path);
            echo $controller->getByName($name);
        } elseif ($method == "POST" && $path == "/api/product") {
            echo $controller->insert();
        } elseif ($method == "PUT" && str_contains($path, "/api/product/")) {
            $id = basename($path);
            echo $controller->update($id);
        } elseif ($method == "DELETE" && str_contains($path, "/api/product/")) {
            $id = basename($path);
            echo $controller->delete($id);
        } else {
            echo $controller->apiResponse(404, "Route not found", null);
        }
    }
}
