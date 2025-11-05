import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    alert: {
        type: string,
        title: string,
        text: string
    },
    is_sheet: boolean
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Category {
    id: string,
    name: string
}

export interface Menu {
    id: number,
    name: string,
    image: string,
    price: number,
    label: string,
    show: booelan,
    category?: Category
}

export interface Event {
    id: number,
    name: string,
    date: string,
    date_english: string,
    date_raw: string,
    start_time: string,
    end_time: string,
    image: string,
    description: string,
    description_full: string,
    organizer?: string,
    show: boolean
}
export interface WeeklyEvent extends Event {
    day: string,
    day_number: number,
    hour: string,
    time_english: string,
}
export interface Reservation {
    id: number,
    name: string,
    group: string,
    agenda: string,
    menu_type: string,
    count: number,
    type: string,
    phone: string,
    date: string,
    plain_date: string,
    hour_start: string,
    hour_end: string,
    status: null | 'Diterima' | 'Ditolak'
}
