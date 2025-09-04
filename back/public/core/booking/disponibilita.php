<?php

function getDisp($dateA, $dateD, $adulti, $bambini, $db) {
    if (!$dateA || !$dateD || $adulti === null || $bambini === null) {
            return "Errore: Valori mancanti";
    }
    try{
        $dateAObj = DateTime::createFromFormat('Y-m-d', $dateA);
        $dateDObj = DateTime::createFromFormat('Y-m-d', $dateD);

        if ((!$dateAObj || $dateAObj->format('Y-m-d') !== $dateA) ||
            (!$dateDObj || $dateDObj->format('Y-m-d') !== $dateD)) {
            echo '(' . $dateA . ', ' . $dateD . ')';
            throw new Exception('Formato data non valido. Usa YYYY-MM-DD. (' . $dateA . ', ' . $dateD . ')');

        }

        if ($dateDObj <= $dateAObj) {
            throw new Exception("La data di check-out deve essere successiva alla data di check-in.");
        }

        $ospitiTotali = $adulti + $bambini;

        $db->where("capacita", $ospitiTotali, ">=");
        $camereAdatte = $db->get("camere", null, "*");

        if (empty($camereAdatte)) {
            return [];
        }

        $idCamereAdatte = array_column($camereAdatte, 'id');

        $dateAStr = $dateAObj->format('Y-m-d');
        $dateDStr = $dateDObj->format('Y-m-d');

        $db->where("camera_id", $idCamereAdatte, "IN");
        $db->where("data_checkin", $dateDStr, "<");
        $db->where("data_checkout", $dateAStr, ">");
        $prenotazioniOccupate = $db->get("prenotazioni", null, "camera_id");
    } catch (Exception $e) {
        return "Errore nella validazione delle date: " . $e->getMessage();
    }
    $camereOccupate = array_column($prenotazioniOccupate, "camera_id");

    $camereDisponibili = array_filter($camereAdatte, function($camera) use ($camereOccupate) {
        return !in_array($camera['id'], $camereOccupate);
    });

    return array_values($camereDisponibili);

}
