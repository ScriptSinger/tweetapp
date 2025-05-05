<template>
  <div class="p-4 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Твиты</h2>
    <ul>
      <li
        v-for="tweet in tweets"
        :key="tweet.id"
        class="bg-white border border-gray-200 p-4 rounded-lg shadow-lg transition-transform transform hover:scale-105 mb-4"
      >
        <div class="flex items-center justify-between mb-2">
          <strong class="text-lg text-blue-600">{{ tweet.username }}</strong>
          <span class="text-sm text-gray-500">{{ tweet.category.title }}</span>
        </div>
        <p class="text-gray-700 mb-2">{{ tweet.content }}</p>
        <small class="text-sm text-gray-400">{{
          new Date(tweet.created_at).toLocaleString()
        }}</small>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/services/api'

const tweets = ref([])

const fetchTweets = async () => {
  const res = await api.get('/tweets')
  tweets.value = res.data.tweets
}

onMounted(fetchTweets)
</script>
