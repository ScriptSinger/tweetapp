<template>
  <div>
    <h2 class="text-xl font-bold mb-2">Категории</h2>
    <ul v-if="categories.length">
      <li v-for="category in categories" :key="category.id" class="mb-1">
        {{ category.title }}
      </li>
    </ul>
    <p v-else>Загрузка категорий...</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/services/api'

const categories = ref([])

onMounted(async () => {
  try {
    const response = await api.get('/categories')
    categories.value = response.data.data // доступ к массиву внутри "data"
  } catch (error) {
    console.error('Ошибка при загрузке категорий:', error)
  }
})
</script>
