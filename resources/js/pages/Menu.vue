<script setup lang="ts">
import MenuCard from '@/components/MenuCard.vue';
import { Button } from '@/components/ui/button';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Category, Menu } from '@/types';
import { ref } from 'vue';

const { categories, menus } = defineProps<{
  menus: { [key: string]: Menu[] },
  categories: Category[]
}>()
const selected = ref(categories[0].id)
</script>
<template>
  <GuestLayout>
    <div
      class="px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] py-8 mv-8 bg-cover relative text-white text-center flex justify-center items-center">
      <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
      <div class="relative z-10 text-center">
        <h1 class="text-4xl lg:text-6xl font-playfair font-semibold">Discover the Taste of Breakshot Bali</h1>
        <p class="my-8">
          From signature local dishes to international favorites and refreshing drinks, our menu is crafted to make
          every moment more enjoyable
        </p>
        <Button size="lg" as-child>
          <a href="#menu">
            See All Menu
          </a>
        </Button>
      </div>
    </div>

    <div class="container mx-auto px-8 sm:px-18 md:px-32 mt-20 scroll-mt-20" id="menu">
      <h2 class="text-3xl md:text-4xl font-playfair font-semibold text-center">Our Menu</h2>
      <p class="mt-5 text-center">
        Explore a wide selection of food and beverages, perfect for any mood
      </p>
      <div class="overflow-x-auto mt-8">
        <div class="w-fit flex gap-6">
          <Button :variant="category.id == selected ? 'default' : 'outline'" class="w-45" v-for="category in categories"
            :key="category.id" @click="selected = category.id">
            {{ category.name }}
          </Button>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 my-8">
        <MenuCard v-for="menu in menus[selected]" :key="menu.id" :menu="menu" />
      </div>
    </div>
  </GuestLayout>
</template>