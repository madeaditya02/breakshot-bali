<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import { BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { today } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Reservation',
    href: route('admin.reservations.index'),
  },
  {
    title: 'Tambah',
    href: route('admin.reservations.create'),
  },
];

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
})
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Tambah Reservasi</h2>
      <form class="mt-6 grid grid-cols-6 gap-4" @submit.prevent="form.post(route('admin.reservations.store'))">
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Nama Pemesan<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Nama pemesan" v-model="form.name" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Grup</Label>
          <Input class="mt-2" placeholder="Grup" v-model="form.group" />
          <InputError :message="form.errors.group" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Tanggal<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Popover>
            <PopoverTrigger as-child>
              <Button variant="outline" :class="cn(
                'w-full justify-start text-left font-normal mt-2 text-black',
                !form.date && 'text-muted-foreground',
              )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                {{ form.date ?? "Pick a date" }}
              </Button>
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0">
              <Calendar v-model="form.date" initial-focus :min-value="today('Asia/Singapore')" />
            </PopoverContent>
          </Popover>
          <InputError :message="form.errors.date" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jam Mulai<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input type="time" class="mt-2" v-model="form.hour_start" />
          <InputError :message="form.errors.hour_start" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jam Selesai<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input type="time" class="mt-2" v-model="form.hour_end" />
          <InputError :message="form.errors.hour_end" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Agenda<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Agenda kegiatan" v-model="form.agenda" />
          <InputError :message="form.errors.agenda" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jumlah<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input type="number" min="1" class="mt-2" placeholder="Jumlah orang" v-model="form.count" />
          <InputError :message="form.errors.count" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>No. Telepon<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Contoh: +6281xxxxxxx" v-model="form.phone" />
          <InputError :message="form.errors.phone" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Persiapan<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Select v-model="form.type">
            <SelectTrigger class="mt-2 w-full">
              <SelectValue placeholder="Pilih jenis persiapan" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem value="Karaoke">Karaoke</SelectItem>
                <SelectItem value="Bawa Player">Bawa Player</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
          <InputError :message="form.errors.type" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Menu<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Select v-model="form.menu_type">
            <SelectTrigger class="mt-2 w-full">
              <SelectValue placeholder="Pilih jenis menu" />
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
        <div class="col-span-full">
          <Button>Simpan</Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>