<script setup lang="ts">
import { Button } from '@/components/ui/button';
import GuestLayout from '@/layouts/GuestLayout.vue';

</script>
<template>
  <GuestLayout>
    <div
      class="px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] py-8 mv-8 bg-cover relative text-white text-center flex justify-center items-center">
      <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
      <div class="relative z-10 text-center">
        <h1 class="text-4xl lg:text-6xl font-playfair font-semibold">Moments at Breakshot Bali</h1>
        <p class="my-8">
          A glimpse of our nights — from karaoke sessions and live performances to unforgettable events
        </p>
        <Button size="lg" as-child>
          <a href="#gallery">
            See All Pics
          </a>
        </Button>
      </div>
    </div>

    <div class="container mx-auto px-8 sm:px-18 md:px-32 mt-20 scroll-mt-20 mb-6" id="gallery">
      <h2 class="text-3xl md:text-4xl font-playfair font-semibold">Karaoke Pic</h2>
      <p class="mt-5">
        Our karaoke nights are where laughter and music come together
      </p>
      <div class="mt-12 grid grid-cols-12 gap-4 auto-rows-[280px]">
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5">
          <img src="/assets/galeri-13.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7">
          <img src="/assets/galeri-4.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:ol-span-12">
          <img src="/assets/galeri-8.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7">
          <img src="/assets/galeri-6.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5">
          <img src="/assets/galeri-17.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
      </div>
    </div>
  </GuestLayout>
</template>