<template>
  <form
    @submit.prevent="submitTweet"
    class="max-w-lg mx-auto space-y-6 bg-white p-6 rounded-lg shadow-lg"
  >
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Напишите твит</h2>

    <input
      v-model="username"
      type="text"
      placeholder="Ваше имя"
      class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
    />

    <textarea
      v-model="content"
      placeholder="Введите твит"
      class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
    ></textarea>

    <CategorySelector v-model="categoryId" class="w-full" />

    <button
      type="submit"
      class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition duration-200 transform hover:scale-105"
    >
      Отправить
    </button>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'

import api from '@/services/api'
import CategorySelector from './CategorySelector.vue'

const username = ref('')
const content = ref('')
const categoryId = ref('')
const tweets = ref([])

const fetchTweets = async () => {
  const res = await api.get('/tweets')
  tweets.value = res.data.tweets
}

onMounted(fetchTweets)

const submitTweet = async () => {
  if (!username.value || !content.value || !categoryId.value) return

  await api.post('/tweets', {
    username: username.value,
    content: content.value,
    category_id: categoryId.value,
  })

  content.value = ''
  await fetchTweets()
}
</script>
