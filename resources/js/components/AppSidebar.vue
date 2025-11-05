<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Box, CalendarDays, LayoutGrid, Utensils } from 'lucide-vue-next';
import NavUser from './NavUser.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Home',
        href: '/admin',
        isActive: route().current('admin.dashboard'),
        icon: LayoutGrid,
    },
    {
        title: 'Reservation',
        href: '/admin/reservations',
        isActive: route().current('admin.reservations.*'),
        icon: CalendarDays,
    },
    {
        title: 'Menu',
        href: '/admin/menu',
        isActive: route().current('admin.menu.*'),
        icon: Utensils,
    },
    {
        title: 'Events',
        href: '/admin/events',
        isActive: route().current('admin.events.*'),
        icon: Box,
    },
];

// const footerNavItems: NavItem[] = [
//     {
//         title: 'Github Repo',
//         href: 'https://github.com/laravel/vue-starter-kit',
//         icon: Folder,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#vue',
//         icon: BookOpen,
//     },
// ];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('admin.dashboard')">
                        <div class="font-medium text-xl">Breakshot Bali</div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <!-- <NavFooter :items="footerNavItems" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
