<script setup lang="ts">
import EventCard from '@/components/EventCard.vue';
import MenuCard from '@/components/MenuCard.vue';
import { Button } from '@/components/ui/button';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Menu, WeeklyEvent } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Instagram, MapPin, Phone } from 'lucide-vue-next';

defineProps<{
  menus: Menu[],
  weekly: WeeklyEvent[],
}>()

document.addEventListener('scroll', () => {
  const value = window.scrollY
  const hero = document.querySelector<HTMLElement>('#hero .content')
  if (hero) {
    hero.style.top = "calc(50% - " + value * 0.8 + "px)"
  }
})
</script>
<template>
  <GuestLayout>
    <!-- Hero -->
    <div
      class="container mx-auto px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] bg-cover bg-fixed relative text-white"
      id="hero">
      <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
      <div
        class="w-full sm:w-[75%] mx-auto absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 z-10 px-6 text-center content">
        <h1 class="text-4xl lg:text-7xl font-playfair font-semibold" data-aos="top">Where Good Food Meets Great Vibes
        </h1>
        <p class="my-8 text-xl font-medium" data-aos="top" data-aos-delay="100">Breakshot Bali, a restaurant and lounge
          with karaoke facilities for an
          unforgettable night</p>
        <Button size="lg" data-aos="top" data-aos-delay="200" as-child>
          <a href="#reservation">Reserve Now</a>
        </Button>
      </div>
    </div>

    <!-- About -->
    <div
      class="container mx-auto px-8 sm:px-12 md:px-20 mt-20 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 sm:gap-y-12 items-center">
      <div class="" data-aos="left">
        <h4 class="text-lg font-bold text-primary mb-2.5">About Us</h4>
        <h2 class="text-3xl md:text-5xl font-playfair font-semibold">Resto & Lounge with Karaoke Experience</h2>
      </div>
      <div class="w-full h-[230px]" data-aos="right" data-aos-delay="150">
        <img src="/assets/about-1.jpg" alt="" class="w-full h-full object-cover rounded-lg border-4 border-primary">
      </div>
      <div class="w-full h-[300px] hidden md:flex gap-4" data-aos="left" data-aos-delay="150">
        <img src="/assets/about-2.jpg" alt="" class="w-[45%] h-full object-cover rounded-lg border-4 border-primary">
        <img src="/assets/about-3.jpg" alt="" class="w-[55%] h-full object-cover rounded-lg border-4 border-primary">
      </div>
      <div class="" data-aos="right">
        <p>
          Breakshot Bali brings together dining, music, and entertainment in one vibrant space. More than just a
          restaurant, we offer a modern lounge atmosphere complete with karaoke facilities—perfect for sharing laughter,
          songs, and unforgettable moments with friends and family
        </p>
        <div class="mt-6 flex flex-col md:flex-row gap-x-8 gap-y-4 md:items-center">
          <div class="flex gap-2.5 h-fit items-center">
            <h5 class="font-semibold text-2xl md:text-4xl">43K+</h5>
            <div class="w-px h-10 bg-primary"></div>
            <p class="sm:text-xl">Reservations</p>
          </div>
          <div class="flex gap-2.5 h-fit items-center">
            <h5 class="font-semibold text-2xl md:text-4xl">50K+</h5>
            <div class="w-px h-10 bg-primary"></div>
            <p class="sm:text-xl">Customers</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu -->
    <div class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
      <div class="text-center">
        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Menu</h4>
        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-2.5" data-aos="top" data-aos-delay="150">Our
          Beverages & Special Menu</h2>
        <p data-aos="top" data-aos-delay="300">Recommend & Best Seller of Our Menu</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
        <MenuCard v-for="(menu, i) in menus" :key="menu.id" :menu="menu" data-aos="top" :data-aos-delay="i * 150" />
      </div>
      <div class="mt-12 text-center" data-aos="top">
        <Button size="lg" as-child>
          <Link href="/menu">
          See All Menu
          </Link>
        </Button>
      </div>
    </div>

    <!-- Events -->
    <div class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
      <div class="text-center">
        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Music & Events</h4>
        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-2.5" data-aos="top" data-aos-delay="150">Weekly &
          Monthly Events</h2>
        <p data-aos="top" data-aos-delay="300">Live bands, DJ nights, and special karaoke events — there's always
          something happening at Breakshot Bali.</p>
        <div class="flex flex-col md:flex-row gap-8 mt-8">
          <EventCard class="w-full" :title="weekly[0].name" :hour="`${weekly[0].time_english} - End`"
            :description="weekly[0].description_full" :image="weekly[0].image" data-aos="left" />
          <EventCard class="w-full" :title="weekly[1].name" :hour="`${weekly[1].time_english} - End`"
            :description="weekly[1].description_full" :image="weekly[1].image" data-aos="right" />
        </div>
      </div>
    </div>

    <!-- Reservation -->
    <div
      class="container mx-auto px-8 sm:px-12 md:px-20 py-10 mt-20 text-center bg-[url('/assets/bar.jpg')] bg-cover bg-fixed text-white relative scroll-mt-20"
      id="reservation">
      <div class="absolute inset-0 bg-black/60"></div>
      <div class="relative z-10">
        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Reservation</h4>
        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-8" data-aos="top" data-aos-delay="150">Make Your
          Night Unforgettable</h2>
        <p data-aos="top" data-aos-delay="300">Secure your table today and enjoy a night filled with delicious food,
          refreshing drinks, music, and karaoke.
          Booking has never been easier</p>
        <Button class="mt-8" size="lg" as-child data-aos="top" data-aos-delay="450">
          <Link href="/reservation">
          Start Reserve
          </Link>
        </Button>
      </div>
    </div>

    <!-- Gallery -->
    <div class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
      <div class="text-center">
        <h4 class="text-lg font-bold text-primary mb-2.5">Gallery</h4>
        <h2 class="text-5xl font-playfair font-semibold mb-2.5">Our Activities</h2>
        <p>Take a look at the highlights of our events.</p>
      </div>
      <div class="mt-12 grid grid-cols-12 gap-4 auto-rows-[280px]">
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5" data-aos="top">
          <img src="/assets/galeri-1.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7" data-aos="right"
          data-aos-delay="150">
          <img src="/assets/galeri-14.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:ol-span-12" data-aos>
          <img src="/assets/galeri-4.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7" data-aos="left"
          data-aos-delay="150">
          <img src="/assets/galeri-10.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5" data-aos="bottom">
          <img src="/assets/galeri-8.jpg" alt="" class="w-full h-full object-cover rounded">
        </div>
      </div>
    </div>

    <!-- Contact -->
    <div class="container mx-auto px-8 sm:px-12 md:px-20 my-20">
      <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Contact Us</h4>
      <h2 class="text-5xl font-playfair font-semibold mb-2.5" data-aos="top" data-aos-delay="150">Let’s Connect Over a
        Drink</h2>
      <p data-aos="top" data-aos-delay="300">Visit us for a unique dining and entertainment experience in the heart of
        Denpasar. Reach out for reservations,
        events, or just to say hello</p>
      <div class="flex gap-12 flex-col md:flex-row mt-8">
        <div class="w-full md:w-1/2 grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="top">
            <div class="flex gap-2.5 items-center">
              <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                <MapPin class="size-5" />
              </div>
              <div class="text-xl">Address</div>
            </div>
            <h4 class="text-xl font-medium mt-4">Jl. Letda Tantula No. 1, Denpasar</h4>
          </div>
          <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="top" data-aos-delay="150">
            <div class="flex gap-2.5 items-center">
              <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                <Phone class="size-5" />
              </div>
              <div class="text-xl">Phone</div>
            </div>
            <h4 class="text-xl font-medium mt-4">+62812345679</h4>
          </div>
          <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="bottom">
            <div class="flex gap-2.5 items-center">
              <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                <Instagram class="size-5" />
              </div>
              <div class="text-xl">Instagram</div>
            </div>
            <h4 class="text-xl font-medium mt-4">@breaksot.bali</h4>
          </div>
          <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="bottom" data-aos-delay="150">
            <div class="flex gap-2.5 items-center">
              <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="size-5">
                  <path
                    d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z" />
                </svg>
              </div>
              <div class="text-xl">Tiktok</div>
            </div>
            <h4 class="text-xl font-medium mt-4">breakshotsbali</h4>
          </div>
        </div>
        <div class="w-full md:w-1/2" data-aos="right">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.232630549412!2d115.21870690847938!3d-8.669413291342284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2411e73c79b07%3A0xab4b1b9c4aa04fb1!2sBreak%20Shot%20Bali!5e0!3m2!1sid!2sid!4v1756889611263!5m2!1sid!2sid"
            class="w-full h-full rounded-lg" style="border:0;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>