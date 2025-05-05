<template>
  <div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tweet App</h1>
    <TweetForm />

    <TweetList />
  </div>
</template>

<script setup>
import TweetForm from '@/components/TweetForm.vue'
import TweetList from '@/components/TweetList.vue'
</script>
