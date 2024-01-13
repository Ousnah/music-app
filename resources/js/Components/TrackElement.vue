import { Link } from '@inertiajs/vue3';
<script setup>
defineProps({
    track: Object,
    index: Number,
    active: Boolean,
});
</script>
<template>
    <li
        :class="active ? 'border-green-600' : ''"
        class="flex flex-col items-center justify-center w-64 h-64 gap-x-4 gap-y-8 rounded-lg p-4 border-8 border-transparent relative bg-slate-100 hover:bg-slate-200 cursor-pointer"
    >
        <img
            v-if="track.image"
            :src="`/storage/${track.image}`"
            class="w-32 h-32 rounded-lg"
            :alt="track.title + ' by ' + track.artist"
        />
        {{ track.title }} - {{ track.artist }}
        <div
            class="rounded-full border-2 border-black w-8 h-8 flex items-center justify-center absolute right-2 bottom-2 cursor-pointer"
            @click.stop="$emit('play', track)"
        >
            {{ active ? "⏸" : "▶️" }}
        </div>
        <Link
            v-if="$page.props.auth.user"
            :href="route('tracks.edit', { track: track })"
            class="w-8 h-8 text-2xl flex items-center justify-center absolute right-2 top-2 cursor-pointer bg-blue-500 hover:bg-blue-800 rounded-lg p-4"
            @click.stop
        >
            ✎
        </Link>
        <Link
            v-if="$page.props.auth.user"
            :href="route('tracks.destroy', { track: track })"
            method="delete"
            as="button"
            preserve-scroll
            :only="['tracks']"
            class="w-8 h-8 text-2xl flex items-center justify-center absolute left-2 top-2 cursor-pointer bg-red-500 hover:bg-red-800 rounded-lg p-4"
            @click.stop
        >
            🗑
        </Link>
    </li>
</template>
