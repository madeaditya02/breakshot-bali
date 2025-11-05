<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
// import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Event, WeeklyEvent } from '@/types';
import { Link, router, useForm } from '@inertiajs/vue3';
import { Ellipsis, Eye, EyeClosed, Pencil, Plus, Trash } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Events',
    href: route('admin.events.index'),
  },
];

defineProps<{
  weekly: WeeklyEvent[],
  others: Event[],
  type: string
}>()

const params = new URLSearchParams(window.location.search)

const formFilter = useForm({
  search: params.get('search') ?? '',
})
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <div class="flex mb-6">
        <Button as-child variant="ghost" class="w-52 max-w-full border-b-2 rounded-none"
          :class="{ 'border-primary text-black': type == 'others', 'text-black/50': type != 'others' }">
          <Link :href="route('admin.events.index')">
          Event Lainnya
          </Link>
        </Button>
        <Button variant="ghost" class="w-52 max-w-full border-b-2 rounded-none" as-child
          :class="{ 'border-primary text-black': type == 'weekly', 'text-black/50': type != 'weekly' }">
          <Link :href="route('admin.events.weekly.index')">
          Event Mingguan
          </Link>
        </Button>
      </div>
      <div v-if="type == 'others'">
        <h2 class="text-2xl font-semibold mt-3">Kelola Event Lainnya</h2>
        <div class="flex justify-between items-center mt-4 flex-wrap gap-3.5">
          <form @submit.prevent="formFilter.get('')" class="w-80 flex items-center gap-4">
            <Input placeholder="Search..." v-model="formFilter.search" />
            <Button variant="secondary" size="sm">Search</Button>
          </form>
          <Button as-child>
            <Link :href="route('admin.events.create')">
            <Plus />
            Tambah Event
            </Link>
          </Button>
        </div>

        <Table class="mt-6">
          <TableHeader>
            <TableRow>
              <TableHead>No.</TableHead>
              <TableHead>Tanggal</TableHead>
              <TableHead>Nama Event</TableHead>
              <TableHead>Jam</TableHead>
              <TableHead>Deskripsi</TableHead>
              <TableHead>Penyelenggara</TableHead>
              <TableHead></TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="(event, i) in others" :key="event.id">
              <TableCell :class="{ 'opacity-50': !event.show }">{{ i + 1 }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.date }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.name }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.start_time }} - {{ event.end_time }}
              </TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.description }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.organizer }}</TableCell>
              <TableCell>
                <Popover>
                  <PopoverTrigger>
                    <Ellipsis />
                  </PopoverTrigger>
                  <PopoverContent class="w-40 p-0">
                    <Button variant="ghost" size="lg" class="justify-start w-full cursor-pointer"
                      @click="router.put(`/admin/events/${event.id}/toggle`, { type })">
                      <template v-if="event.show">
                        <Eye />
                        <span>Hide</span>
                      </template>
                      <template v-else>
                        <EyeClosed />
                        <span>Show</span>
                      </template>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start w-full cursor-pointer" as-child>
                      <Link :href="`/admin/events/${event.id}/edit`">
                      <Pencil />
                      <span>Edit</span>
                      </Link>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start w-full cursor-pointer" as-child>
                      <Link method="delete" :href="`/admin/events/${event.id}`">
                      <Trash />
                      <span>Hapus</span>
                      </Link>
                    </Button>
                  </PopoverContent>
                </Popover>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
      <div v-if="type == 'weekly'">
        <h2 class="text-2xl font-semibold mt-3">Kelola Event Mingguan</h2>

        <div class="flex justify-between items-center mt-4 flex-wrap gap-3.5">
          <form @submit.prevent="formFilter.get('')" class="w-80 flex items-center gap-4">
            <Input placeholder="Search..." v-model="formFilter.search" />
            <Button variant="secondary" size="sm">Search</Button>
          </form>
          <Button as-child>
            <Link :href="route('admin.events.weekly.create')">
            <Plus />
            Tambah Event
            </Link>
          </Button>
        </div>

        <Table class="mt-6">
          <TableHeader>
            <TableRow>
              <TableHead>No.</TableHead>
              <TableHead>Nama Event</TableHead>
              <TableHead>Hari</TableHead>
              <TableHead>Jam</TableHead>
              <TableHead>Deskripsi</TableHead>
              <TableHead></TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="(event, i) in weekly" :key="event.id">
              <TableCell :class="{ 'opacity-50': !event.show }">{{ i + 1 }}</TableCell>
              <TableCell class="flex items-center gap-3 font-medium" :class="{ 'opacity-50': !event.show }">
                <img :src="event.image" class="size-10 rounded object-cover" />
                <span>{{ event.name }}</span>
              </TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.day }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.hour }}</TableCell>
              <TableCell :class="{ 'opacity-50': !event.show }">{{ event.description }}</TableCell>
              <TableCell>
                <Popover>
                  <PopoverTrigger>
                    <Ellipsis />
                  </PopoverTrigger>
                  <PopoverContent class="w-40 p-0">
                    <Button variant="ghost" size="lg" class="justify-start w-full"
                      @click="router.put(`/admin/events/${event.id}/toggle`, { type })">
                      <template v-if="event.show">
                        <Eye />
                        <span>Hide</span>
                      </template>
                      <template v-else>
                        <EyeClosed />
                        <span>Show</span>
                      </template>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start w-full" as-child>
                      <Link :href="`/admin/events/weekly/${event.id}/edit`">
                      <Pencil />
                      <span>Edit</span>
                      </Link>
                    </Button>
                    <Button variant="ghost" size="lg" class="justify-start w-full" as-child>
                      <Link method="delete" :href="route('admin.events.weekly.destroy', event.id)">
                      <Trash />
                      <span>Hapus</span>
                      </Link>
                    </Button>
                  </PopoverContent>
                </Popover>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>

    </div>
  </AppLayout>
</template>