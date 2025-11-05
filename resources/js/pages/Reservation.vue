<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import GuestLayout from '@/layouts/GuestLayout.vue';
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useForm } from '@inertiajs/vue3';
import { cn } from '@/lib/utils';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { CalendarIcon } from 'lucide-vue-next';
import { Calendar } from '@/components/ui/calendar';
import InputError from '@/components/InputError.vue';
import Swal from "sweetalert2";
import { Textarea } from '@/components/ui/textarea';
import { today } from '@internationalized/date';

const form = useForm({
  name: '',
  group: '',
  date: undefined,
  hour_start: '',
  hour_end: '',
  agenda: '',
  count: undefined,
  phone: '',
  type: '',
  menu_type: '',
  notes: '',
})
</script>
<template>
  <GuestLayout>
    <div
      class="px-8 sm:px-12 md:px-20 h-screen max-h-160 bg-[url('/assets/bar.jpg')] py-8 mv-8 bg-cover relative text-white text-center flex justify-center items-center">
      <div class="absolute inset-0 bg-linear-to-b from-black to-transparent"></div>
      <div class="relative z-10 text-center">
        <h1 class="text-4xl lg:text-6xl font-playfair font-semibold">Book Your Perfect Night</h1>
        <p class="my-8">
          Secure your spot at Breakshot Bali and enjoy a night of dining, karaoke, and music — all in one place.
        </p>
        <Button size="lg" as-child>
          <a href="#reservation">
            Reserve Now
          </a>
        </Button>
      </div>
    </div>

    <form @submit.prevent="form.post('', {
      onSuccess: () => {
        Swal.fire({
          title: 'Reservasi berhasil!',
          text: 'Silahkan tunggu konfirmasi via Whatsapp. ' + (form.type == 'Bawa Player' ? 'Untuk reservasi bawa player, terdapat minimum belanja senilai Rp. 500.000' : 'Karaoke dilakukan secara bergilir dan tidak ada reservasi untuk fasilitas karaoke'),
          icon: 'success',
        })
        form.reset()
      },
      onError: (error) => {
        if (error.date == 'Sudah ada reservasi di antara tanggal dan waktu tersebut') {
          Swal.fire({
            title: 'Reservasi gagal!',
            text: 'Sudah terdapat reservasi di tanggal dan waktu tersebut',
            icon: 'error',
          })
        }
      }
    })" class="container mx-auto px-8 sm:px-18 md:px-32 mt-20 scroll-mt-20" id="reservation">
      <h2 class="text-3xl md:text-4xl font-playfair font-semibold text-center">Reservation Form</h2>
      <p class="mt-5 text-center">
        Fill out the form below to plan your night with us.
      </p>
      <p class="mt-12 text-sm"><span class="text-red-600">*</span> Wajib Diisi</p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-4">
        <div>
          <Label>Nama Pemesan<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" v-model="form.name" :invalid="form.errors.name"
            placeholder="Nama anda" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>
        <div>
          <Label>Grup</Label>
          <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" v-model="form.group" :invalid="form.errors.group"
            placeholder="Nama grup anda" />
          <InputError :message="form.errors.group" class="mt-1" />
        </div>
        <div>
          <Label>Tanggal<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Popover>
            <PopoverTrigger as-child>
              <Button variant="outline" :class="cn(
                'w-full justify-start text-left font-normal mt-2 bg-[#fafafa]',
                !form.date ? 'text-muted-foreground' : 'text-black',
                form.errors.date && '!border-red-600'
              )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                {{ form.date ?? "Pilih tanggal" }}
              </Button>
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0">
              <Calendar v-model="form.date" initial-focus :min-value="today('Asia/Singapore')" />
            </PopoverContent>
          </Popover>
          <InputError :message="form.errors.date" class="mt-1" />
        </div>
        <div>
          <Label>Jam<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <div class="flex gap-2.5 items-center">
            <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" :invalid="form.errors.hour_start"
              v-model="form.hour_start" type="time" />
            <span>-</span>
            <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" :invalid="form.errors.hour_end" v-model="form.hour_end"
              type="time" />
          </div>
          <InputError :message="form.errors.hour_start ?? form.errors.hour_end" class="mt-1" />
        </div>
        <div>
          <Label>Agenda<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" v-model="form.agenda" :invalid="form.errors.agenda"
            placeholder="Agenda acara anda" />
          <InputError :message="form.errors.agenda" class="mt-1" />
        </div>
        <div>
          <Label>Jumlah<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" v-model="form.count" :invalid="form.errors.count"
            placeholder="Jumlah" />
          <InputError :message="form.errors.count" class="mt-1" />
        </div>
        <div>
          <Label>Jenis Persiapan<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Select v-model="form.type">
            <SelectTrigger class="bg-white w-full mt-2.5">
              <SelectValue placeholder="Pilih karaoke atau bawa player" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem value="Bawa Player">Bawa Player</SelectItem>
                <SelectItem value="Karaoke">Karaoke</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
          <InputError :message="form.errors.type" class="mt-1" />
        </div>
        <div>
          <Label>Pilihan Menu<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Select v-model="form.menu_type">
            <SelectTrigger class="bg-white w-full mt-2.5">
              <SelectValue placeholder="Pilih A la carte atau prasmanan" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem value="A la carte">A la carte</SelectItem>
                <SelectItem value="Prasmanan">Prasmanan</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
          <InputError :message="form.errors.menu_type" class="mt-1" />
        </div>
        <div>
          <Label>Catatan Tambahan</Label>
          <Textarea class="mt-2.5 bg-[#fafafa] border shadow-sm !h-24" v-model="form.notes"
            placeholder="Pesan tambahan yang ingin disampaikan" />
          <InputError :message="form.errors.notes" class="mt-1" />
        </div>
        <div>
          <Label>No. Telepon<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2.5 bg-[#fafafa] border shadow-sm" :invalid="form.errors.phone" v-model="form.phone"
            placeholder="Contoh: +6212345667" />
          <InputError :message="form.errors.phone" class="mt-1" />
        </div>
        <div class="col-span-full text-center mb-4">
          <Button size="lg">Reserve</Button>
        </div>
      </div>
    </form>
  </GuestLayout>
</template>