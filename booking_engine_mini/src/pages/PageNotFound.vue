<script setup>

  function onClickAction () {
    location.replace("/")
  }

</script>
<template>
  <v-empty-state
    action-text="Torna alla home"
    image="https://cdn.vuetifyjs.com/docs/images/components/v-empty-state/connection.svg"
    text="Pagina non esistente."
    title="Qualcosa è andato storto."
    @click:action="onClickAction"
  ></v-empty-state>
</template>