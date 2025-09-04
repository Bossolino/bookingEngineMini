<script setup>
import main from '@/main'
import { watch, ref } from 'vue';

const err = ref(true)

if (main.roomSelected.value === 0) {
    main.router.replace("/");
}

// watch(main.errPren, (newVal) => {
//     if (!newVal) {
//       main.router.replace("/riepilogo");
//     }
//   });

watch([main.nomeOspite, main.emailOspite], () => {
    if (main.nomeOspite.value !== "" && main.emailOspite.value !== "") {
        err.value = false;
    } else {
        err.value = true;
    }
});

main.prezzoTotale.value = main.giorniTotali.value * main.roomSelectedPrice.value;

</script>
<template>
    
<template>
    <v-alert closable :v-if="!main.errPren.value" :text="main.textPren.value" title="Errore" type="error"></v-alert>
</template>
    <v-row>
        <v-col>
            <v-card :title="main.roomSelectedName.value" :text="main.roomSelectedDescription.value">
                <v-row>
                    <v-col>
                        <v-card-text>
                            N° Stanza:{{ main.roomSelected.value }}
                        </v-card-text>
                    </v-col>
                    <v-col>
                        <v-card-text><v-icon icon="mdi-account"></v-icon> N° Persone:{{ main.roomSelectedCapacity.value }}</v-card-text>
                    </v-col>
                </v-row>
                <v-card-text><v-icon icon="mdi-cash"></v-icon> Prezzo per notte: {{ main.roomSelectedPrice.value }}€ </v-card-text>
                <v-card-text>
                    Giorni totali: {{ main.giorniTotali.value }}
                    Prezzo camera: {{ main.roomSelectedPrice.value }} x {{ main.giorniTotali.value }} = {{ main.prezzoTotale.value }}€;
                </v-card-text>
                <v-card-actions>
                    <v-row>
                        <v-col>
                            <v-form @submit.prevent="main.confermaPren">
                                <v-col cols="20">
                                    <v-row>
                                        <v-col><v-text-field required v-model="main.nomeOspite.value" label="Inserisci il nome"></v-text-field>
                                            <sub style="color: red;">*Inserire il nome completo.<br>*Per il checkin è richiesto un documento.<br>*Il nome deve combaciare con il nome scritto nel documento.</sub>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col><v-text-field required v-model="main.emailOspite.value" label="inserisci l'email"></v-text-field></v-col>
                                        <p v-if="err.value" color="red">*Compila tutti i campi*</p>
                                    </v-row>
                                </v-col>
                                <v-btn :disabled="err" variant="tonal" color="success" prepend-icon="mdi-check" @click="main.confermaPren()">Conferma Prenotazione</v-btn>
                            </v-form>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>