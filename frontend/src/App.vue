<template>
  <!-- Хедер: вне ограниченного контейнера -->
  <div class="w-full sticky top-0 z-50">
    <TweetHeader />
  </div>

  <div class="max-w-xl mx-auto p-4">
    <TweetForm />
    <TweetList />
  </div>
</template>

<script setup>
import TweetHeader from '@/components/TweetHeader.vue'
import TweetForm from '@/components/TweetForm.vue'
import TweetList from '@/components/TweetList.vue'
</script>
