<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ ."/../../core/booking/disponibilita.php";
class DisponibilitaController {
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    public function getDisp($request, $response, $args){
        $db = new MysqliDb('127.0.0.1', 'root', '', 'hotel');
        $dateA = $request->getQueryParams()['dataA'] ?? null;
        $dateD = $request->getQueryParams()['dataD'] ?? null;
        $adulti = $request->getQueryParams()['adulti'] ?? null;
        $bambini = $request->getQueryParams()['bambini'] ?? null;
        $stanze = getDisp($dateA, $dateD, $adulti, $bambini,$db);
        if (gettype($stanze) == "String" && $stanze.str_contains("Errore")) {
            $response->getBody()->write($stanze);
            return $response = $response->withHeader('Content-type', 'text/html');
        } else {
            $response->getBody()->write(json_encode($stanze));
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;
        }
    }
}