<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import FileInput from '@/components/FileInput.vue';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Event',
    href: route('admin.events.index'),
  },
  {
    title: 'Tambah',
    href: route('admin.reservations.create'),
  },
];

const form = useForm({
  name: '',
  day: undefined,
  hour: '',
  description: '',
  image: undefined,
})

const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]

const imagePreview = computed(() => {
  const file = form.image as File | undefined
  if (file) {
    return URL.createObjectURL(file)
  }
  return null
})
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Tambah Event</h2>
      <form class="mt-6 grid grid-cols-6 gap-4" @submit.prevent="form.post(route('admin.events.weekly.store'))">
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Nama Event<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Nama event" v-model="form.name" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Hari<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Select v-model="form.day">
            <SelectTrigger class="mt-2 w-full">
              <SelectValue placeholder="Pilih hari" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem v-for="(day, i) in days" :key="i" :value="i">{{ day }}</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
          <InputError :message="form.errors.day" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jam<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input type="time" class="mt-2" placeholder="Jam kegiatan" v-model="form.hour" />
          <InputError :message="form.errors.hour" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Gambar<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <FileInput class="mt-2" accept="image/*" v-model="form.image" />
          <InputError :message="form.errors.image" class="mt-1" />
          <img v-if="imagePreview" :src="imagePreview" class="w-full h-40 object-cover mt-2 rounded-md border" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Deskripsi</Label>
          <Textarea class="mt-2" v-model="form.description" placeholder="Deskripsi kegiatan" />
          <InputError :message="form.errors.description" class="mt-1" />
        </div>
        <div class="col-span-full">
          <Button>Simpan</Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>