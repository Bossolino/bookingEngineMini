<script setup>
import main from '@/main'
const props = defineProps({
    nStanza: Number,
    titolo: String,
    descrizione: String,
    capacita: Number,
    prezzo: String,
    btn: Boolean
 });

 function vai(){
    main.router.push(`/prenotazione/${props.titolo}`)
    main.roomSelected.value = props.nStanza;
    main.roomSelectedName.value = props.titolo;
    main.roomSelectedDescription.value = props.descrizione;
    main.roomSelectedCapacity.value = props.capacita;
    main.roomSelectedPrice.value = props.prezzo;

 }
</script>
<template>
    <v-row>
        <v-col>
            <v-card :title="props.titolo" :text="props.descrizione">
                <v-row>
                    <v-col>
                        <v-card-text>
                            N° Stanza:{{ props.nStanza }}
                        </v-card-text>
                    </v-col>
                    <v-col>
                        <v-card-text>
                    N° Persone:{{ props.capacita }}
                </v-card-text>
                    </v-col>
                </v-row>
                <v-card-text>
                Prezzo per notte: {{ props.prezzo }}€
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="tonal" color="info" prepend-icon="mdi-bed" @click="vai()">Prenota</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>