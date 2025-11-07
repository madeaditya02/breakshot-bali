<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Breakshot Bali more than just a restaurant, we offer a modern lounge atmosphere complete with karaoke facilities">
    <meta name="keywords" content="Breakshot Bali, breakshot, bali, restaurant, resto, lounge, karaoke">
    <meta name="author" content="Breakshot Bali">
    <title>Breakshot Bali</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @routes
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="min-h-screen bg-transparent">
        {{-- Navbar --}}
        <div class="relative z-10">
            <header
                class="navbar px-8 sm:px-12 md:px-20 py-4 flex flex-col md:flex-row justify-between items-center fixed top-0 left-0 right-0 transition-all z-40 text-white">
                <div class="flex justify-between w-full md:w-auto">
                    <a href="/">
                        <img src="/assets/logo.jpg" alt="" class="size-12 object-cover rounded-md">
                    </a>
                    <button class="md:hidden nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="nav-menu hidden md:flex flex-col md:flex-row gap-4 lg:gap-8  items-center">
                    <a href="/">Home</a>
                    <a href="/menu">Menu</a>
                    <a href="/reservation">Reservation</a>
                    <a href="/events">Events</a>
                    <a href="/gallery">Gallery</a>
                </div>
            </header>

            {{-- Content --}}
            <main>
                {{-- Hero --}}
                <section
                    class="container mx-auto px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] bg-cover bg-fixed relative text-white"
                    id="hero" style="background-image: url('/assets/bar.jpg')">
                    <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
                    <div
                        class="w-full sm:w-[75%] mx-auto absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 z-30 px-6 text-center content">
                        <h1 class="text-4xl lg:text-7xl font-playfair font-semibold !text-white" data-aos="top">Where
                            Good Food
                            Meets Great Vibes
                        </h1>
                        <p class="my-8 text-xl font-medium" data-aos="top" data-aos-delay="100">Breakshot Bali, a
                            restaurant and lounge
                            with karaoke facilities for an
                            unforgettable night</p>
                        <a data-slot="button"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground shadow-xs hover:bg-primary/90 h-10 rounded-md px-6 has-[&gt;svg]:px-4 show"
                            data-aos="top" data-aos-delay="200" href="#reservation">
                            Reserve Now
                        </a>
                    </div>
                </section>
                <section
                    class="container mx-auto px-8 sm:px-12 md:px-20 mt-20 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 sm:gap-y-12 items-center">
                    <article class="" data-aos="left">
                        <h4 class="text-lg font-bold text-primary mb-2.5">About Us</h4>
                        <h2 class="text-3xl md:text-5xl font-playfair font-semibold">Resto & Lounge with Karaoke
                            Experience</h2>
                    </article>
                    <div class="w-full h-[230px]" data-aos="right" data-aos-delay="150">
                        <img src="/assets/about-1.jpg" alt=""
                            class="w-full h-full object-cover rounded-lg border-4 border-primary">
                    </div>
                    <div class="w-full h-[300px] hidden md:flex gap-4" data-aos="left" data-aos-delay="150">
                        <img src="/assets/about-2.jpg" alt=""
                            class="w-[45%] h-full object-cover rounded-lg border-4 border-primary">
                        <img src="/assets/about-3.jpg" alt=""
                            class="w-[55%] h-full object-cover rounded-lg border-4 border-primary">
                    </div>
                    <div class="" data-aos="right">
                        <p>
                            Breakshot Bali brings together dining, music, and entertainment in one vibrant space. More
                            than just a
                            restaurant, we offer a modern lounge atmosphere complete with karaoke facilities—perfect for
                            sharing laughter,
                            songs, and unforgettable moments with friends and family
                        </p>
                        <div class="mt-6 flex flex-col md:flex-row gap-x-8 gap-y-4 md:items-center">
                            <article class="flex gap-2.5 h-fit items-center">
                                <h5 class="font-semibold text-2xl md:text-4xl">200+</h5>
                                <div class="w-px h-10 bg-primary"></div>
                                <p class="sm:text-xl">Reservations</p>
                            </article>
                            <article class="flex gap-2.5 h-fit items-center">
                                <h5 class="font-semibold text-2xl md:text-4xl">100+</h5>
                                <div class="w-px h-10 bg-primary"></div>
                                <p class="sm:text-xl">Customers</p>
                            </article>
                        </div>
                    </div>
                </section>

                {{-- Menu --}}
                <section class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
                    <div class="text-center">
                        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Menu</h4>
                        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-2.5" data-aos="top"
                            data-aos-delay="150">Our
                            Beverages & Special Menu</h2>
                        <p data-aos="top" data-aos-delay="300">Recommend & Best Seller of Our Menu</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                        @foreach ($menu as $item)
                            <div class="bg-white rounded-2xl p-6 text-center relative">
                                <img src="{{ $item->image }}" class="h-40 w-full object-cover mb-4" alt="">
                                <h3 class="text-xl md:text-2xl font-semibold font-playfair mb-2.5">{{ $item->name }}
                                </h3>
                                <div class="sm:text-xl">IDR 20000</div>
                                @if ($item->label)
                                    <div
                                        class="absolute top-0 left-0 rounded-2xl px-2.5 py-1.5 bg-primary text-white text-sm flex items-center gap-1.5">
                                        @if ($item->label == 'Best Seller')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-thumbs-up-icon lucide-thumbs-up">
                                                <path d="M7 10v12" />
                                                <path
                                                    d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
                                            </svg>
                                        @elseif ($item->label == 'Recommended')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-sparkles-icon lucide-sparkles">
                                                <path
                                                    d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                                <path d="M20 2v4" />
                                                <path d="M22 4h-4" />
                                                <circle cx="4" cy="20" r="2" />
                                            </svg>
                                        @endif
                                        <span>{{ $item->label }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-12 text-center" data-aos="top">
                        <a data-slot="button"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground shadow-xs hover:bg-primary/90 h-10 rounded-md px-6 has-[&gt;svg]:px-4 show"
                            data-aos="top" data-aos-delay="200" href="/menu">
                            See All Menu
                        </a>
                    </div>
                </section>

                {{-- Event --}}
                <section class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
                    <div class="text-center">
                        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Music & Events</h4>
                        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-2.5" data-aos="top"
                            data-aos-delay="150">Weekly &
                            Monthly Events</h2>
                        <p data-aos="top" data-aos-delay="300">Live bands, DJ nights, and special karaoke events —
                            there's always
                            something happening at Breakshot Bali.</p>
                        <div class="flex flex-col md:flex-row gap-8 mt-8">
                            @foreach ($weekly as $event)
                                <article class="h-80 p-8 rounded bg-cover relative"
                                    style="background-image: url('{{ $event->image }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                                    <div class="relative z-10 text-white flex flex-col justify-end h-full">
                                        <h3 class="text-4xl font-semibold font-playfair text-left">{{ $event->name }}
                                        </h3>
                                        <div class="mt-5 flex gap-2.5 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            {{ now()->startOfWeek()->addDays($event->weekly_day - 1)->isoFormat('dddd') .', ' .now()->startOfDay()->setTimeFromTimeString($event->weekly_hour)->isoFormat('h:mm A') }}
                                            - End
                                        </div>
                                        <p class="mt-5 text-lg text-left">
                                            {{ $event->description }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- Reservation --}}
                <section
                    class="container mx-auto px-8 sm:px-12 md:px-20 py-10 mt-20 text-center bg-cover bg-fixed text-white relative scroll-mt-20"
                    id="reservation" style="background-image: url('/assets/bar.jpg');">
                    <div class="absolute inset-0 bg-black/60"></div>
                    <div class="relative z-10">
                        <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Reservation</h4>
                        <h2 class="text-3xl md:text-5xl font-playfair font-semibold mb-8" data-aos="top"
                            data-aos-delay="150">Make Your
                            Night Unforgettable</h2>
                        <p data-aos="top" data-aos-delay="300">Secure your table today and enjoy a night filled with
                            delicious food,
                            refreshing drinks, music, and karaoke.
                            Booking has never been easier</p>
                        <a data-slot="button"
                            class="inline-flex mt-8 items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground shadow-xs hover:bg-primary/90 h-10 rounded-md px-6 has-[&gt;svg]:px-4 show"
                            data-aos="top" data-aos-delay="200" href="/reservation">
                            Start Reserve
                        </a>
                    </div>
                </section>

                {{-- Gallery --}}
                <section class="container mx-auto px-8 sm:px-12 md:px-20 mt-20">
                    <div class="text-center">
                        <h4 class="text-lg font-bold text-primary mb-2.5">Gallery</h4>
                        <h2 class="text-5xl font-playfair font-semibold mb-2.5">Our Activities</h2>
                        <p>Take a look at the highlights of our events.</p>
                    </div>
                    <div class="mt-12 grid grid-cols-12 gap-4 auto-rows-[280px]">
                        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5"
                            data-aos="top">
                            <img src="/assets/galeri-1.jpg" alt=""
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7"
                            data-aos="right" data-aos-delay="150">
                            <img src="/assets/galeri-14.jpg" alt=""
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:ol-span-12"
                            data-aos>
                            <img src="/assets/galeri-4.jpg" alt=""
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-7"
                            data-aos="left" data-aos-delay="150">
                            <img src="/assets/galeri-10.jpg" alt=""
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div class="rounded-lg border-4 border-primary overflow-hidden col-span-12 md:col-span-5"
                            data-aos="bottom">
                            <img src="/assets/galeri-8.jpg" alt=""
                                class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                </section>
            </main>

            {{-- Contact --}}
            <div class="container mx-auto px-8 sm:px-12 md:px-20 my-20">
                <h4 class="text-lg font-bold text-primary mb-2.5" data-aos="top">Contact Us</h4>
                <h2 class="text-5xl font-playfair font-semibold mb-2.5" data-aos="top" data-aos-delay="150">Let’s
                    Connect Over a
                    Drink</h2>
                <p data-aos="top" data-aos-delay="300">Visit us for a unique dining and entertainment experience in
                    the heart of
                    Denpasar. Reach out for reservations,
                    events, or just to say hello</p>
                <div class="flex gap-12 flex-col md:flex-row mt-8">
                    <div class="w-full md:w-1/2 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="top">
                            <div class="flex gap-2.5 items-center">
                                <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-map-pin-icon lucide-map-pin">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </div>
                                <div class="text-xl">Address</div>
                            </div>
                            <h4 class="text-xl font-medium mt-4">Jl. Letda Tantula No. 1, Denpasar</h4>
                        </div>
                        <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="top" data-aos-delay="150">
                            <div class="flex gap-2.5 items-center">
                                <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-phone-icon lucide-phone">
                                        <path
                                            d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                    </svg>
                                </div>
                                <div class="text-xl">Phone</div>
                            </div>
                            <h4 class="text-xl font-medium mt-4">+62812345679</h4>
                        </div>
                        <div class="bg-[#F1F0EA] rounded-lg p-5" data-aos="bottom">
                            <div class="flex gap-2.5 items-center">
                                <div class="size-8 rounded-full flex justify-center items-center bg-[#B09080]/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-instagram-icon lucide-instagram">
                                        <rect width="20" height="20" x="2" y="2" rx="5"
                                            ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                    </svg>
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

            {{-- Footer --}}
            <footer
                class="px-8 sm:px-12 md:px-20 py-8 bg-[#5C4033] text-white grid grid-cols-12 gap-x-4 gap-y-6 md:gap-x-9">
                <div class="col-span-full md:col-span-3">
                    <img src="/assets/logo.jpg" alt="" class="size-12 object-cover rounded-md">
                    <h2 class="text-2xl font-playfair font-medium mt-2">Breakshots Bali</h2>
                    <p class="mt-2">Where good food, live music, and karaoke come together.</p>
                </div>
                <div class="hidden sm:block col-span-3"></div>
                <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
                    <h4 class="font-playfair text-lg font-medium">Links</h4>
                    <a href="/">Home</a>
                    <a href="/menu">Menu</a>
                    <a href="/reservation">Reservation</a>
                    <a href="/events">Events</a>
                </div>
                <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
                    <h4 class="font-playfair text-lg font-medium">Hours</h4>
                    <div>11.00 WITA - Closed</div>
                </div>
                <div class="col-span-6 sm:col-span-2 flex flex-col gap-2.5 sm:gap-4">
                    <h4 class="font-playfair text-lg font-medium">Company</h4>
                    <a href="/">Terms of Service</a>
                    <a href="/">Privacy Policy</a>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('scroll', () => {
            const scrolled = window.scrollY > 0
            if (scrolled) {
                document.querySelector('.navbar').classList.add('bg-primary/90')
            } else {
                document.querySelector('.navbar').classList.remove('bg-primary/90')

            }
        })
        let showNav = false;
        document.querySelector('.nav-btn').addEventListener('click', () => {
            showNav = !showNav
            if (showNav) {
                document.querySelector('.navbar').classList.add('!bg-primary/90')
                document.querySelector('.nav-menu').classList.add('flex')
                document.querySelector('.nav-menu').classList.remove('hidden')
            } else {
                document.querySelector('.navbar').classList.remove('!bg-primary/90')
                document.querySelector('.nav-menu').classList.remove('flex')
                document.querySelector('.nav-menu').classList.add('hidden')
            }
        })

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
    </script>
</body>

</html>
