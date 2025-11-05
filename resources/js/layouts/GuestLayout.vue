<script setup lang="ts">
import { assertIsNode } from '@/lib/utils';
import { Link, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';

const showNav = ref(false)
const scrolled = ref(false)
scrolled.value = window.scrollY > 0
document.addEventListener('scroll', () => {
  scrolled.value = window.scrollY > 0
})
const page = usePage()
onMounted(() => {
  const navbar = document.querySelector('.navbar')
  document.addEventListener('click', event => {
    assertIsNode(event.target)
    if (!(event.target == navbar || navbar?.contains(event.target))) {
      showNav.value = false
    }
  })

  if (page.props.alert) {
    console.log(page.props.alert.type);
    if (page.props.alert.type == 'success') {
      Swal.fire({
        title: page.props.alert.title,
        text: page.props.alert.title,
        icon: 'success',
      });
      // toast.success(page.props.alert.title, {
      //     description: page.props.alert.text
      // })
    } else if (page.props.alert.type == 'error') {
      Swal.fire({
        title: page.props.alert.title,
        text: page.props.alert.title,
        icon: 'error',
      });
      // toast.error(page.props.alert.title, {
      //   description: page.props.alert.text
      // })
    }
    else {
      // toast(page.props.alert.title, {
      //   description: page.props.alert.text
      // })
    }
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const delay = entry.target.getAttribute('data-aos-delay')
      if (delay) {
        setTimeout(() => {
          entry.target.classList.toggle('show', entry.isIntersecting)
        }, parseInt(delay))
      } else entry.target.classList.toggle('show', entry.isIntersecting)
      if (entry.isIntersecting) observer.unobserve(entry.target)
    })
  }, {
    threshold: 0.6
  })
  document.querySelectorAll("[data-aos]").forEach(el => observer.observe(el))
})
document.body.classList.remove('admin')
// document.body.classList.remove('auth')
</script>
<template>
  <div class="min-h-screen bg-transparent">
    <div class="relative z-10">
      <div
        class="navbar px-8 sm:px-12 md:px-20 py-4 flex flex-col md:flex-row justify-between items-center fixed top-0 left-0 right-0 transition-all z-40 text-white"
        :class="{ 'bg-primary/90': scrolled, '!bg-primary/90': showNav }">
        <div class="flex justify-between w-full md:w-auto">
          <Link href="/">
          <!-- <h2 class="text-xl">Breakshot Bali</h2> -->
          <img src="/assets/logo.jpg" alt="" class="size-12 object-cover rounded-md">
          </Link>
          <button class="md:hidden" @click="showNav = !showNav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-7">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="flex-col md:flex-row gap-4 lg:gap-8  items-center"
          :class="{ 'hidden md:flex': !showNav, 'flex': showNav }">
          <Link href="/">Home</Link>
          <Link href="/menu">Menu</Link>
          <Link href="/reservation">Reservation</Link>
          <Link href="/events">Events</Link>
          <Link href="/gallery">Gallery</Link>
        </div>
      </div>
      <div>
        <slot />
      </div>
      <footer class="px-8 sm:px-12 md:px-20 py-8 bg-[#5C4033] text-white grid grid-cols-12 gap-x-4 gap-y-6 md:gap-x-9">
        <div class="col-span-full md:col-span-3">
          <img src="/assets/logo.jpg" alt="" class="size-12 object-cover rounded-md">
          <h2 class="text-2xl font-playfair font-medium mt-2">Breakshots Bali</h2>
          <p class="mt-2">Where good food, live music, and karaoke come together.</p>
        </div>
        <div class="hidden sm:block col-span-3"></div>
        <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
          <h4 class="font-playfair text-lg font-medium">Links</h4>
          <Link href="/">Home</Link>
          <Link href="/menu">Menu</Link>
          <Link href="/reservation">Reservation</Link>
          <Link href="/events">Events</Link>
        </div>
        <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
          <h4 class="font-playfair text-lg font-medium">Hours</h4>
          <div>11.00 WITA - Closed</div>
        </div>
        <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
          <h4 class="font-playfair text-lg font-medium">Company</h4>
          <Link href="/">Terms of Service</Link>
          <Link href="/">Privacy Policy</Link>
        </div>
      </footer>
    </div>
  </div>
</template>