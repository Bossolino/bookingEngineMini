<?php

function setPren($nome, $email, $dataA, $dataD, $idStanza, $db){
    $data = Array(
        "nome_cliente" => $nome,
        "email_cliente" => $email,
        "data_checkin" => $dataA,
        "data_checkout" => $dataD,
        "camera_id" => $idStanza
    );
    if($db->insert('prenotazioni',$data)){
        return "Prenotazione confermata co successo!";
    } else {
        return "Conferma prenotazione fallita, controllare i campi inseriti e riprovare.";
    }
}