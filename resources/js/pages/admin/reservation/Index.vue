<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Reservation } from '@/types';
import { Link, router, useForm } from '@inertiajs/vue3';
import { Check, Ellipsis, Pencil, Phone, Plus, Trash, X } from 'lucide-vue-next';
import Swal from 'sweetalert2';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Reservation',
    href: route('admin.reservations.index'),
  },
];

defineProps<{
  reservations: Reservation[]
}>()

const params = new URLSearchParams(window.location.search)

const formFilter = useForm({
  search: params.get('search') ?? ''
})
</script>
<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <h2 class="text-2xl font-semibold">Kelola Reservasi</h2>

      <div class="flex justify-between items-center mt-4 flex-wrap gap-3.5">
        <form @submit.prevent="formFilter.get('')" class="w-80 flex items-center gap-4">
          <Input placeholder="Search..." v-model="formFilter.search" />
          <Button variant="secondary" size="sm">Search</Button>
        </form>
        <Button as-child>
          <Link :href="route('admin.reservations.create')">
          <Plus />
          Tambah Reservasi
          </Link>
        </Button>
      </div>

      <Table class="mt-6">
        <TableHeader>
          <TableRow>
            <TableHead>Tanggal</TableHead>
            <TableHead>Nama Pemesan</TableHead>
            <TableHead>Grup</TableHead>
            <TableHead>Agenda</TableHead>
            <TableHead>Menu</TableHead>
            <TableHead>Jumlah</TableHead>
            <TableHead>Jam</TableHead>
            <TableHead>Persiapan</TableHead>
            <TableHead></TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="reservation in reservations" :key="reservation.id"
            :class="({ 'bg-green-50 hover:bg-green-100/55': reservation.status == 'Diterima', 'bg-red-50 hover:bg-red-100/55': reservation.status == 'Ditolak' })">
            <TableCell>{{ reservation.date }}</TableCell>
            <TableCell>
              <a :href="`http://wa.me/${reservation.phone}`" target="_blank" class="underline">
                {{ reservation.name }}
              </a>
            </TableCell>
            <TableCell>{{ reservation.group }}</TableCell>
            <TableCell>{{ reservation.agenda }}</TableCell>
            <TableCell>{{ reservation.menu_type }}</TableCell>
            <TableCell>{{ reservation.count }}</TableCell>
            <TableCell>{{ reservation.hour_start }} - {{ reservation.hour_end }}</TableCell>
            <TableCell>{{ reservation.type }}</TableCell>
            <TableCell>
              <Popover>
                <PopoverTrigger>
                  <Ellipsis />
                </PopoverTrigger>
                <PopoverContent class="w-40 p-0">
                  <Button variant="ghost" size="lg" class="justify-start w-full" as-child>
                    <Link :href="`/admin/reservations/${reservation.id}/edit`">
                    <Pencil />
                    <span>Edit</span>
                    </Link>
                  </Button>
                  <Button variant="ghost" size="lg" class="justify-start w-full" as-child>
                    <Link method="delete" :href="route('admin.reservations.destroy', reservation.id)" v-on:success="Swal.fire({
                      title: 'Reservasi berhasil dihapus!',
                      // text: 'Silahkan tunggu konfirmasi via Whatsapp',
                      icon: 'success',
                    })">
                    <Trash />
                    <span>Hapus</span>
                    </Link>
                  </Button>
                  <Button variant="ghost" size="lg" class="justify-start w-full" as-child>
                    <a target="_blank" :href="`http://wa.me/${reservation.phone}`">
                      <Phone />
                      <span>Hubungi</span>
                    </a>
                  </Button>
                  <Button variant="ghost" size="lg" class="justify-start w-full"
                    v-if="reservation.status ? reservation.status == 'Ditolak' : reservation.status != 'Diterima'"
                    @click="router.post(`/admin/reservations/${reservation.id}/confirm`, { accept: true }, {
                      onSuccess: () => Swal.fire({
                        title: 'Status reservasi berhasil diubah!',
                        text: 'Status reservasi diubah ke Diterima dan tersimpan di spreadsheet',
                        icon: 'success',
                      })
                    })">
                    <Check />
                    <span>Terima</span>
                  </Button>
                  <Button variant="ghost" size="lg" class="justify-start w-full"
                    v-if="reservation.status ? reservation.status == 'Diterima' : reservation.status != 'Ditolak'"
                    @click="router.post(`/admin/reservations/${reservation.id}/confirm`, { accept: false }, {
                      onSuccess: () => Swal.fire({
                        title: 'Status reservasi berhasil diubah!',
                        text: 'Status reservasi diubah ke Ditolak dan tersimpan di spreadsheet',
                        icon: 'success',
                      })
                    })">
                    <X />
                    <span>Tolak</span>
                  </Button>
                </PopoverContent>
              </Popover>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </AppLayout>
</template>