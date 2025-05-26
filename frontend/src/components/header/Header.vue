<template>
  <header class="w-full border-b border-gray-200 bg-white">
    <div class="h-14 w-full px-20 flex items-center justify-between">
      <!-- Навигация слева -->
      <div class="flex items-center space-x-6">
        <RouterLink
          to="/"
          class="text-gray-600 hover:text-blue-600"
          active-class="text-blue-700 font-semibold"
          exact-active-class="text-blue-700 font-bold"
        >
          Home
        </RouterLink>

        <RouterLink
          to="/about"
          class="text-gray-600 hover:text-blue-600"
          active-class="text-blue-700 font-semibold"
        >
          About
        </RouterLink>
      </div>

      <!-- Иконка справа -->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 text-blue-500"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-2M7 8H5a2 2 0 00-2 2v8a2 2 0 002 2h2m10-12V4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m10 0H7"
        />
      </svg>
    </div>
  </header>
</template>
