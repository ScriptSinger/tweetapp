<template>
  <div class="p-4 max-w-3xl mx-auto">
    <ul>
      <li
        v-for="tweet in tweets"
        :key="tweet.id"
        class="bg-white border border-gray-200 p-4 rounded-lg shadow-lg transition-transform transform hover:scale-105 mb-4"
      >
        <div class="flex items-center justify-between mb-2">
          <p class="text-lg text-blue-600 break-words w-1/2">{{ tweet.username }}</p>
          <span class="text-sm text-gray-500">{{ tweet.category.title }}</span>
        </div>
        <p class="text-gray-700 mb-2 break-words">{{ tweet.content }}</p>
        <small class="text-sm text-gray-400">{{
          new Date(tweet.created_at).toLocaleString()
        }}</small>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import api from '@/services/api'
import echo from '@/services/echo'

const tweets = ref([])

const fetchTweets = async () => {
  const res = await api.get('/tweets')
  tweets.value = res.data.tweets
}

onMounted(fetchTweets)

onMounted(() => {
  echo.channel('tweets').listen('TweetCreated', (tweet) => {
    console.log('🟢 Tweet created event received:', tweet)
    if (!tweet || !tweet.id) {
      console.warn('⚠️ Некорректный tweet:', tweet)
      return
    }
    tweets.value.unshift(tweet)
  })
})

onBeforeUnmount(() => {
  echo.leave('tweets')
})
</script>
