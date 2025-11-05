<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog } from '@/components/ui/dialog';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import { Input } from '@/components/ui/input';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Menu } from '@/types';
import { Link, useForm } from '@inertiajs/vue3';
import { Ellipsis, Eye, EyeClosed, Pencil, Plus, Trash } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
  menus: Menu[]
}>()
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Menu',
    href: '/admin/menu',
  },
];

const params = new URLSearchParams(window.location.search)

const formFilter = useForm({
  search: params.get('search') ?? ''
})

const selectedImage = ref<string>()
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Kelola Menu</h2>
      <div class="flex justify-between items-center mt-4 flex-wrap gap-3.5">
        <form @submit.prevent="formFilter.get('')" class="w-80 flex items-center gap-4">
          <Input placeholder="Search..." v-model="formFilter.search" />
          <Button variant="secondary" size="sm">Search</Button>
        </form>
        <Button as-child>
          <Link :href="route('admin.menu.create')">
          <Plus />
          Tambah Menu
          </Link>
        </Button>
      </div>
      <div class="mt-6 overflow-x-auto">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>
                Menu
              </TableHead>
              <TableHead>Harga</TableHead>
              <TableHead>Kategori</TableHead>
              <TableHead>
                Label
              </TableHead>
              <TableHead></TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="menu in menus" :key="menu.id">
              <TableCell class="font-medium flex items-center gap-3" :class="{ 'opacity-50': !menu.show }">
                <img :src="menu.image" class="size-10 rounded object-cover cursor-pointer"
                  @click="selectedImage = menu.image" />
                <span>{{ menu.name }}</span>
              </TableCell>
              <TableCell :class="{ 'opacity-50': !menu.show }">{{ menu.price }}</TableCell>
              <TableCell :class="{ 'opacity-50': !menu.show }">{{ menu.category?.name }}</TableCell>
              <TableCell :class="{ 'opacity-50': !menu.show }">{{ menu.label }}</TableCell>
              <TableCell class="sm:w-[100px]">
                <Popover>
                  <PopoverTrigger class="sm:hidden">
                    <Ellipsis />
                  </PopoverTrigger>
                  <PopoverContent class="w-40 p-0">
                    <Button variant="ghost" size="lg" class="justify-start" as-child>
                      <Link :href="`/admin/menu/${menu.id}/toggle`" method="put" class="inline-flex gap-1 items-center">
                      <template v-if="menu.show">
                        <Eye />
                        <span>Hide</span>
                      </template>
                      <template v-else>
                        <EyeClosed />
                        <span>Show</span>
                      </template>
                      </Link>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start" as-child>
                      <Link :href="`/admin/menu/${menu.id}/edit`">
                      <Pencil />
                      <span>Edit</span>
                      </Link>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start" as-child>
                      <Link method="delete" :href="route('admin.menu.destroy', menu.id)">
                      <Trash />
                      <span>Hapus</span>
                      </Link>
                    </Button>
                  </PopoverContent>
                </Popover>
                <div class="hidden sm:flex items-center gap-2.5 w-fit">
                  <Button variant="secondary" size="sm" class="text-black" as-child>
                    <Link :href="`/admin/menu/${menu.id}/toggle`" method="put" class="inline-flex gap-1 items-center">
                    <template v-if="menu.show">
                      <Eye />
                      <span class="hidden lg:inline">Hide</span>
                    </template>
                    <template v-else>
                      <EyeClosed />
                      <span class="hidden lg:inline">Show</span>
                    </template>
                    </Link>
                  </Button>
                  <Button variant="warning" size="sm" as-child>
                    <Link :href="`/admin/menu/${menu.id}/edit`" class="inline-flex gap-1 items-center">
                    <Pencil />
                    <span class="hidden lg:inline">Edit</span>
                    </Link>
                  </Button>
                  <Button variant="destructive" size="sm">
                    <Link method="delete" :href="`/admin/menu/${menu.id}`" class="inline-flex items-center gap-1">
                    <Trash />
                    <span class="hidden lg:inline">Hapus</span>
                    </Link>
                  </Button>
                </div>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>

    <Dialog :open="!!selectedImage" @update:open="open => selectedImage = open ? selectedImage : undefined">
      <DialogContent>
        <img :src="selectedImage" class="w-full h-full max-w-xl max-h-100 object-cover" alt="">
      </DialogContent>
    </Dialog>
  </AppLayout>
</template>