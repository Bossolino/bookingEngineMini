<script setup>
import main from '@/main'

// if (main.roomSelected.value===0){
//     main.router.replace('/');
// }

</script>
<template>
    <v-container>
        <v-row>
            <v-alert type="success" title="Successo" text="Prenotazione confermata."></v-alert>
        </v-row>
        <v-row>
            <v-col>
                <v-card>
                    <v-card-title><h3>Hotel test</h3></v-card-title>
                    <v-card-subtitle>Riepilogo prenotazione</v-card-subtitle>
                    <v-card-text>Grazie per la tua prenotazione.</v-card-text>
                    <v-card-text>
                        Nome: <strong>{{ main.nomeOspite.value }}</strong>
                        Email: <strong>{{ main.emailOspite.value }}</strong>
                    </v-card-text>
                    <v-card-text>
                        Data checkin: <strong>{{ main.stringData(main.dataArrivo.value) }}</strong>
                        Data checkout: <strong>{{ main.stringData(main.dataPartenza.value) }}</strong>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>   
        <v-row>
            <v-col>
                <v-card>
                    <v-card-title><h3>{{ main.roomSelectedName.value }}</h3></v-card-title>
                    <v-card-text>
                        {{ main.roomSelectedDescription.value }}
                    </v-card-text>
                    <v-card-text>
                        <v-icon icon="mdi-account"></v-icon>Stanza per N° {{ main.roomSelectedCapacity.value }} persiona/e.
                        <v-icon icon="mdi-cash"></v-icon>Costo {{ main.roomSelectedPrice.value }}€ a notte.
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>   
        <v-row>
            <v-col>
                <v-card>
                    <v-card-text>
                        Giorni totali: {{ main.giorniTotali.value }}
                        Prezzo camera: {{ main.giorniTotali.value }} x {{ main.roomSelectedPrice.value }} = {{ main.prezzoTotale.value }}
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-card>
                    <v-card-text>
                        Totale: {{ main.prezzoTotale.value }}€
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="text-center"><v-btn prepend-icon="mdi-home" text="Torna alla Home" to="/"></v-btn></v-col>
        </v-row>
    </v-container>

</template>