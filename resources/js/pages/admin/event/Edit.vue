<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Event } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';
import { CalendarIcon } from 'lucide-vue-next';
import { Calendar } from '@/components/ui/calendar';
import FileInput from '@/components/FileInput.vue';
import { Textarea } from '@/components/ui/textarea';
import { computed } from 'vue';
import { parseDate } from '@internationalized/date';

const props = defineProps<{
  event: Event
}>()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Event',
    href: route('admin.events.index'),
  },
  {
    title: 'Edit',
    href: route('admin.events.edit', props.event.id),
  },
];


const form = useForm({
  name: props.event.name,
  date: parseDate(props.event.date_raw) as any,
  start_time: props.event.start_time,
  end_time: props.event.end_time,
  description: props.event.description,
  organizer: props.event.organizer,
  image: undefined,
})

const imagePreview = computed(() => {
  const file = form.image as File | undefined
  if (file) {
    return URL.createObjectURL(file)
  }
  return props.event.image
})
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Edit Event</h2>
      <form class="mt-6 grid grid-cols-6 gap-4"
        @submit.prevent="form.transform(data => ({ ...data, _method: 'put' })).post(`/admin/events/${event.id}`)">
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Nama Event<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Nama event" v-model="form.name" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Tanggal<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Popover>
            <PopoverTrigger as-child>
              <Button variant="outline" :class="cn(
                'w-full justify-start text-left font-normal mt-2',
                !form.date && 'text-muted-foreground',
              )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                {{ form.date ?? "Pick a date" }}
              </Button>
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0">
              <Calendar v-model="form.date" initial-focus />
            </PopoverContent>
          </Popover>
          <InputError :message="form.errors.date" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Penyelenggara</Label>
          <Input class="mt-2" placeholder="Pihak terkait" v-model="form.organizer" />
          <InputError :message="form.errors.organizer" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Gambar Pamflet</Label>
          <FileInput class="mt-2" accept="image/*" v-model="form.image" />
          <InputError :message="form.errors.image" class="mt-1" />
          <img v-if="imagePreview" :src="imagePreview" class="w-full h-40 object-cover mt-2 rounded-md border" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jam Mulai<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input type="time" class="mt-2" placeholder="Jam mulai kegiatan" v-model="form.start_time" />
          <InputError :message="form.errors.start_time" class="mt-1" />
        </div>
        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
          <Label>Jam Selesai</Label>
          <Input type="time" class="mt-2" placeholder="Jam selesai kegiatan" v-model="form.end_time" />
          <InputError :message="form.errors.end_time" class="mt-1" />
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