<script setup>
import main from '@/main';

</script>
<template>
    <v-container>
        <v-row class="margin-0-auto">
            <v-col cols="10"><v-btn prepend-icon="mdi-arrow-left" text="Back" to="/"></v-btn></v-col>
            <v-col cols="10"><CardCameraSelected></CardCameraSelected></v-col>
            
        </v-row>
    </v-container>
</template>