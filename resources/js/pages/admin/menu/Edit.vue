<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Combobox, ComboboxAnchor, ComboboxEmpty, ComboboxGroup, ComboboxInput, ComboboxItem, ComboboxItemIndicator, ComboboxList, ComboboxTrigger } from '@/components/ui/combobox';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Category, Menu } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Check, ChevronsUpDown, Search } from 'lucide-vue-next';
import { cn } from '@/lib/utils';
import FileInput from '@/components/FileInput.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
  menu: Menu
  categories: Category[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Menu',
    href: '/admin/menu',
  },
  {
    title: 'Edit',
    href: `/admin/menu/${props.menu.id}/edit`,
  },
];
const form = useForm({
  name: props.menu.name,
  price: props.menu.price,
  label: props.menu.label,
  category: { ...props.menu.category },
  image: undefined,
})

const imagePreview = computed(() => {
  const file = form.image as File | undefined
  if (file) {
    return URL.createObjectURL(file)
  }
  return props.menu.image
})

const textKategori = ref(props.menu.category!.name)

const addCategory = () => {
  const strCategory = textKategori.value.replace('Tambah', '').replace('""', '').trim()
  const newCategory = {
    id: strCategory.toLowerCase().split(' ').join('-'),
    name: strCategory.charAt(0).toUpperCase() + strCategory.slice(1)
  }
  form.category = newCategory
  document.querySelector<HTMLDivElement>('form > div:first-child')?.click()
}
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Edit Menu</h2>
      <form class="mt-6 grid grid-cols-6 gap-4"
        @submit.prevent="form.transform((data) => ({ ...data, category: data.category.id })).put(route('admin.menu.update', menu.id))">
        <div class="col-span-2">
          <Label>Nama Menu<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Nama menu" v-model="form.name" />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>
        <div class="col-span-2">
          <Label>Harga<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <Input class="mt-2" placeholder="Harga menu" type="number" v-model="form.price" />
          <InputError :message="form.errors.price" class="mt-1" />
        </div>
        <div class="col-span-2">
          <Label>Label</Label>
          <Select v-model="form.label">
            <SelectTrigger class="mt-2 w-full">
              <SelectValue placeholder="Pilih antara best seller atau recommended" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem value="Best Seller">Best Seller</SelectItem>
                <SelectItem value="Recommended">Recommended</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
        </div>
        <div class="col-span-2">
          <Label>Gambar Menu<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <!-- <Input type="file" class="mt-2" placeholder="Upload gambar menu" /> -->
          <FileInput class="mt-2" accept="image/*" v-model="form.image" />
          <InputError :message="form.errors.image" class="mt-1" />
          <img v-if="imagePreview" :src="imagePreview" class="w-full h-40 object-cover mt-2 rounded-md border" />
        </div>
        <div class="col-span-2 relative">
          <Label>Kategori<span class="text-red-600" title="Wajib diisi">*</span></Label>
          <!-- <Combobox by="label"
            @update:model-value="(val: Category) => props.categories.find(c => c.id == val.id) ? val : addKategori(val as Category)"
            class="w-full">
            <ComboboxAnchor as-child>
              <ComboboxTrigger as-child>
                <Button variant="outline" class="justify-between w-full font-normal">
                  {{ form.category ?? 'Pilih Kategori' }}

                  <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
              </ComboboxTrigger>
            </ComboboxAnchor>

            <ComboboxList class="!w-full px-0">
              <div class="relative w-full items-center">
                <ComboboxInput class="pl-3 w-full focus-visible:ring-0 border-0 border-b rounded-none h-10"
                  placeholder="Cari kategori..." v-model="textKategori" />
                <span class="absolute start-0 inset-y-0 flex items-center justify-center px-3">
                  <Search class="size-4 text-muted-foreground" />
                </span>
              </div>
              <ComboboxGroup class="w-full">
                <ComboboxItem v-for="framework in dataKategori" :key="framework.id" :value="framework">
                  {{ framework.name }}
                </ComboboxItem>
              </ComboboxGroup>
            </ComboboxList>
          </Combobox> -->
          <Combobox v-model="form.category" by="name" class="mt-2 w-full">
            <ComboboxAnchor as-child class="w-full">
              <ComboboxTrigger as-child>
                <Button variant="outline" class="justify-between">
                  {{ form.category.name != '' ? form.category.name : 'Pilih kategori' }}

                  <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
              </ComboboxTrigger>
            </ComboboxAnchor>

            <ComboboxList class="w-full">
              <div class="relative w-full items-center">
                <ComboboxInput class="focus-visible:ring-0 border-0 border-b rounded-none h-10"
                  placeholder="Pilih kategori..." v-model="textKategori" />
                <span class="absolute start-0 inset-y-0 flex items-center justify-center px-3">
                  <Search class="size-4 text-muted-foreground" />
                </span>
              </div>

              <ComboboxEmpty class="p-4 text-left cursor-pointer hover:bg-black/5" @click="addCategory">
                Tambah '{{ textKategori }}'
              </ComboboxEmpty>

              <ComboboxGroup>
                <ComboboxItem v-for="framework in props.categories" :key="framework.id" :value="framework">
                  {{ framework.name }}

                  <ComboboxItemIndicator v-if="form.category.id == framework.id">
                    <Check :class="cn('ml-auto h-4 w-4')" />
                  </ComboboxItemIndicator>
                </ComboboxItem>
              </ComboboxGroup>
            </ComboboxList>
          </Combobox>
          <InputError :message="form.errors.category" class="mt-1" />
        </div>
        <div class="col-span-full">
          <Button>Simpan</Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>