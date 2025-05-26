<template>
  <div class="max-w-xl mx-auto p-4">
    <TweetForm />
    <TweetList />
  </div>
</template>
<script setup>
import TweetForm from "./tweets/TweetForm.vue";
import TweetList from "./tweets/TweetList.vue";
</script>
