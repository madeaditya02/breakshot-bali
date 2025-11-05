<script setup lang="ts">
import EventCard from '@/components/EventCard.vue';
import { Button } from '@/components/ui/button';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Event, WeeklyEvent } from '@/types';
import { Calendar1 } from 'lucide-vue-next';

defineProps<{
  weekly: WeeklyEvent[],
  others: Event[]
}>()

</script>
<template>
  <GuestLayout>
    <div
      class="px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] py-8 bg-cover relative text-white text-center flex justify-center items-center">
      <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
      <div class="relative z-10 text-center">
        <h1 class="text-4xl lg:text-6xl font-playfair font-semibold">Feel the Beat, Live the Night</h1>
        <p class="my-8">
          From weekly music shows to exclusive one-time performances, Breakshot Bali is where every night becomes a
          celebration.
        </p>
        <Button size="lg">
          <a href="#events">See All Events</a>
        </Button>
      </div>
    </div>

    <div class="container mx-auto px-8 sm:px-12 md:px-20 mt-20 scroll-mt-20" id="events">
      <h2 class="text-3xl md:text-4xl font-playfair font-semibold text-center">Weekly Events</h2>
      <div class="flex flex-col md:flex-row gap-8 mt-8">
        <EventCard v-for="event in weekly" :key="event.id" class="w-full" :title="event.name"
          :hour="`${event.time_english}, - End`" :description="event.description_full" :image="event.image" />
      </div>
    </div>

    <div class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
      <h2 class="text-3xl md:text-5xl font-playfair font-semibold">Others Events</h2>
      <div class="mt-12 mb-20 flex flex-col gap-8">
        <div v-for="event in others" :key="event.id" class="bg-[#F1F0EA] rounded-lg p-8 flex gap-7">
          <img :src="event.image" alt="" class="h-[140px] w-60 rounded-lg">
          <div>
            <h3 class="text-3xl font-semibold font-playfair">{{ event.name }}</h3>
            <div class="flex items-center gap-2.5 mt-5">
              <Calendar1 />
              <span>{{ event.date_english }}</span>
            </div>
            <p class="mt-5">
              {{ event.description_full }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>