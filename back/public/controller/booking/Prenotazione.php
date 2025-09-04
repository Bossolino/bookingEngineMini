<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ ."/../../core/booking/prenotazione.php";

class PrenotazioneController {
        public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function setPren($request, $response, $args) {
        $db = new MysqliDb('127.0.0.1', 'root', '', 'hotel');
        $parsedBody = $request->getParsedBody();
        $nome = $parsedBody['nome'] ?? null;
        $email = $parsedBody['email'] ?? null;
        $dataA = $parsedBody['dataArrivo'] ?? null;
        $dataD = $parsedBody['dataPartenza'] ?? null;
        $idStanza = $parsedBody['roomSelected'] ?? null;
        if (!$nome || !$email || !$dataA || !$dataD || !$idStanza) {
            $response->getBody()->write("Impossibile completare la prenotazione, controllare i campi inseriti e riprovare.");
            return $response = $response->withHeader('Content-type', 'text/html');
        }
        $prenotazione = setPren($nome, $email, $dataA, $dataD, $idStanza, $db);
        $response->getBody()->write($prenotazione);
        return $response = $response->withHeader('Content-type', 'text/html');
    }
}