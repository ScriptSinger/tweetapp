<template>
  <form
    @submit.prevent="submitTweet"
    class="max-w-lg mx-auto space-y-6 bg-white p-6 rounded-lg shadow-lg"
  >
    <div>
      <input
        v-model="username"
        type="text"
        placeholder="Ваше имя"
        class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
      <p v-if="errors.username" class="text-red-600 text-sm mt-1">
        {{ errors.username[0] }}
      </p>
    </div>

    <div>
      <textarea
        v-model="content"
        placeholder="Введите твит"
        class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
      ></textarea>
      <p v-if="errors.content" class="text-red-600 text-sm mt-1">
        {{ errors.content[0] }}
      </p>
    </div>

    <div>
      <CategorySelector v-model="categoryId" class="w-full" />
      <p v-if="errors.category_id" class="text-red-600 text-sm mt-1">
        {{ errors.category_id[0] }}
      </p>
    </div>

    <button
      type="submit"
      class="cursor-pointer w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition duration-200 transform hover:scale-105"
    >
      Отправить
    </button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import api from '@/services/api'
import CategorySelector from './CategorySelector.vue'

const username = ref('')
const content = ref('')
const categoryId = ref('')
const errors = ref({})

const submitTweet = async () => {
  errors.value = {} // Очистка старых ошибок

  try {
    await api.post('/tweets', {
      username: username.value,
      content: content.value,
      category_id: categoryId.value,
    })

    // Очистка формы после успешной отправки
    content.value = ''
    // optionally: username.value = '', categoryId.value = ''
  } catch (error) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors
    } else {
      console.error('Неожиданная ошибка:', error)
    }
  }
}
</script>
