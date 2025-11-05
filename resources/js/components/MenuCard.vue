<script setup lang="ts">
import { Menu } from '@/types';
import { Sparkles, ThumbsUp } from 'lucide-vue-next';

defineProps<{
  menu?: Menu
}>()
</script>
<template>
  <div class="bg-white rounded-2xl p-6 text-center relative">
    <img :src="menu?.image" class="h-40 w-full object-cover mb-4" alt="">
    <h3 class="text-xl md:text-2xl font-semibold font-playfair mb-2.5">{{ menu?.name }}</h3>
    <div class="sm:text-xl">IDR {{ menu?.price }}</div>
    <div class="absolute top-0 left-0 rounded-2xl px-2.5 py-1.5 bg-primary text-white text-sm flex items-center gap-1.5"
      v-if="menu?.label">
      <Sparkles v-if="menu.label == 'Best Seller'" class="size-4" />
      <ThumbsUp v-if="menu.label == 'Recommended'" class="size-4" />
      <span>{{ menu.label }}</span>
    </div>
  </div>
</template>