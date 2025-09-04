<script setup>
  import { computed , ref, watch } from 'vue'
  import main from '@/main'

  const dataMinP = ref();

  const da = computed({
    get() {
      return main.stringData(main.dataArrivo.value);
    },
    set(value) {
      main.dataArrivo.value = new Date(value);
    }
  });
  const dp = computed({
    get() {
      return main.stringData(main.dataPartenza.value);
    },
    set(value) {
      main.dataPartenza.value = new Date(value);
    }
  });

  watch(main.dataArrivo, (newVal) => {
    if (main.dataPartenza.value <= newVal) {
      const nuovaPartenza = new Date(newVal);
      nuovaPartenza.setDate(nuovaPartenza.getDate() + 1);
      main.dataPartenza.value = nuovaPartenza;
    }
  });

  //!↓questo watch da sistemare
  watch(main.dataPartenza, (newVal) => {
    if (newVal <= main.dataArrivo.value) {
      const nuovaPartenza = new Date(main.stringData(main.dataArrivo.value));
      nuovaPartenza.setDate(nuovaPartenza.getDate() + 1);
      main.dataPartenza.value = nuovaPartenza;
      // console.log(main.dataPartenza.value)
    }
  });

  watch(main.dataPartenza, () => {
    main.dataArrivo.value.setHours(0, 0, 0, 0);
    main.dataPartenza.value.setHours(0, 0, 0, 0);
    const diff = Math.abs(main.dataPartenza.value - main.dataArrivo.value);
    main.giorniTotali.value =  Math.floor(diff / (1000 * 60 * 60 * 24));
    // console.log(main.giorniTotali.value)
  });

</script>
<template id="temp">
  <v-container>
    <v-row>
      <v-spacer></v-spacer>
      <h3>Hotel test</h3>
      <v-spacer></v-spacer>
    </v-row>
    <v-divider class="mx-3" vertical></v-divider>
    <v-row>
      <v-col size="small">
        <v-row><v-text-field label="Data arrivo" v-model="da" type="date" :disabled="main.carica.value" :min="new Date().toISOString().slice(0, 10)" :loading="main.carica.value"></v-text-field></v-row>
        <v-row><v-text-field label="Data partenza" v-model="dp" type="date" :disabled="main.carica.value" :min="dataMinP" :loading="main.carica.value" ></v-text-field></v-row>
      </v-col>
      <v-spacer></v-spacer>
      <v-col>
          <v-row>
              <v-number-input label="Adulti" v-model="main.adulti.value" :disabled="main.carica.value" :loading="main.carica.value" control-variant="split" :min=1 ></v-number-input>
            </v-row>
            <v-row>
                <v-number-input label="Bambini (0-12)" v-model="main.bambini.value" :disabled="main.carica.value" :loading="main.carica.value" control-variant="split" :min=0></v-number-input>
            </v-row>
        </v-col>
        <v-col>
          <v-tooltip text="Cerca" location="end">
            <template v-slot:activator="{ props }">
              <v-btn v-bind="props" :disabled="main.carica.value" :loading="main.carica.value" hint="main.carica.value" icon="mdi-magnify" @click="main.cercaCamere()"></v-btn>
            </template>
          </v-tooltip>
        </v-col>
    </v-row>
    <v-divider></v-divider>
    <v-progress-linear :active="main.carica.value" color="info" indeterminate></v-progress-linear>
  </v-container>
</template>