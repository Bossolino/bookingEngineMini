<script setup>
import main from '@/main'
import { onMounted, ref } from 'vue';

const translated = ref('')

async function changeLan(lang) {
    localStorage.setItem("lang", lang)
    main.lingua.value = lang;
    translated.value = await main.translate("Ciao come stai?")
}

onMounted(async () => {
    translated.value = await main.translate("Ciao come stai?")
})
</script>

<template>
  <div height="5%" class="text-center">
    <v-col md="100">
      <v-btn @click="changeLan('it')" icon>
        <v-img max-height="30px" width="auto" src="..\assets\italy.png"></v-img>
      </v-btn>
    </v-col>
    <v-col md="">
      <v-btn @click="changeLan('en')" icon>
        <v-img max-height="30px" width="auto" src="..\assets\united-kingdom.png"></v-img>
      </v-btn>
    </v-col>
    <v-col md="">
      <v-btn @click="changeLan('es')" icon>
        <v-img max-height="30px" width="auto" src="..\assets\spain.png"></v-img>
      </v-btn>
    </v-col>
    <p>{{ translated }}</p>
  </div>
</template>
