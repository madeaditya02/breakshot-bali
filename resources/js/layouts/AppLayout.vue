<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import Swal, { SweetAlertIcon } from 'sweetalert2';
import { onMounted, ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import InputError from '@/components/InputError.vue';
// import { toast } from 'vue-sonner';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage()

onMounted(() => {
    if (page.props.alert) {
        Swal.fire({
            title: page.props.alert.title,
            text: page.props.alert.text,
            icon: page.props.alert.type as SweetAlertIcon,
        })
        // if (page.props.alert.type == 'success') {
        //     toast.success(page.props.alert.title, {
        //         description: page.props.alert.text
        //     })
        // } else if (page.props.alert.type == 'error') {
        //     toast.error(page.props.alert.title, {
        //         description: page.props.alert.text
        //     })
        // }
        // else {
        //     toast(page.props.alert.title, {
        //         description: page.props.alert.text
        //     })
        // }
    }
})

const showSheetConfirm = ref(!page.props.is_sheet)
function closePermanent() {
    fetch('/admin/close-sheet')
    showSheetConfirm.value = false
}
const sheetUrl = useForm({
    url: ''
})

document.body.classList.add('admin')
document.body.classList.remove('auth')
</script>

<template>
    <Toaster rich-colors position="top-right" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
    <Dialog :open="showSheetConfirm" @update:open="opened => showSheetConfirm = opened">
        <DialogContent>
            <form action="" @submit.prevent="sheetUrl.post('/admin/set-sheet', {
                onSuccess: () => {
                    showSheetConfirm = false
                    Swal.fire({
                        title: 'Spreadsheet berhasil ditambahkan',
                        icon: 'success',
                    })
                }
            })">
                <DialogHeader>
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-20 mx-auto text-red-700 mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <DialogTitle>File Spreadsheet Tidak Ditemukan</DialogTitle>
                    </div>
                    <DialogDescription>
                        File Google Sheet untuk penyimpanan reservasi tahun ini tidak ditemukan. Silahkan masukkan
                        url/link
                        dari spreadsheet yang baru.
                    </DialogDescription>
                    <Input name="link" placeholder="Link file spreadhseet" required v-model="sheetUrl.url" />
                    <InputError :message="sheetUrl.errors.url" />
                </DialogHeader>
                <DialogFooter class="mt-4">
                    <Button variant="outline" type="button" @click="closePermanent">Keluar dan Biarkan Kosong</Button>
                    <Button type="submit">Simpan</Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>