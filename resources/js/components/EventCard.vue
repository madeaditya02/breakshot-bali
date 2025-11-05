<script setup lang="ts">
defineProps<{
  title: string,
  hour: string,
  description?: string,
  image: string
}>()
</script>
<template>
  <div class="h-80 p-8 rounded bg-cover relative" :style="{ 'background-image': `url(${image})` }">
    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
    <div class="relative z-10 text-white flex flex-col justify-end h-full">
      <h3 class="text-4xl font-semibold font-playfair text-left">{{ title }}</h3>
      <div class="mt-5 flex gap-2.5 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ hour }}
      </div>
      <p class="mt-5 text-lg text-left">
        {{ description }}
      </p>
    </div>
  </div>
</template>