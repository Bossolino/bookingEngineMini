<script setup>
import main from '@/main'
import axios from 'axios';
import { onMounted, watch, ref } from 'vue';

onMounted(()=>{
  main.cercaCamere();
})

watch([main.dataArrivo, main.dataPartenza, main.adulti, main.bambini], () =>{
  main.cercaCamere();
});

</script>
<template>
  <NavBar></NavBar>
  <v-container >
    <v-alert v-if="main.nessCameraDisp.value" type="error" title="Attenzione" text="Nessuna camera disponibile per i parametri selezionati."></v-alert>
    <CardCamera v-if="!main.nessCameraDisp.value" v-for="camera in main.camereDisp.value" :capacita="camera.capacita" :titolo="camera.nome" :descrizione="camera.descrizione" :prezzo="camera.prezzo_base" :nStanza="camera.id"></CardCamera>
  </v-container>
</template>

