<script setup>
import { RouterLink, RouterView } from "vue-router";
import Header from "./components/header/Header.vue";
</script>

<template>
  <Header />
  <main class="p-6">
    <RouterView />
  </main>
</template>
