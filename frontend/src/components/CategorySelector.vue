<template>
  <select v-model="selected" class="border p-2 rounded">
    <option disabled value="">Выберите категорию</option>
    <option v-for="cat in categories" :key="cat.id" :value="cat.id">
      {{ cat.title }}
    </option>
  </select>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { defineProps, defineEmits } from 'vue'
import api from '@/services/api'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const selected = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val),
})

// Категории
const categories = ref([])

const fetchCategories = async () => {
  try {
    const response = await api.get('/categories')
    categories.value = response.data.data // ← используем поле `data`
  } catch (error) {
    console.error('Ошибка при загрузке категорий:', error)
  }
}

onMounted(fetchCategories)
</script>
