<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    track: Object,
});

const form = useForm({
    title: props.track.title,
    artist: props.track.artist,
    image: props.track.image,
    music: props.track.music,
    display: props.track.display === 1 ? true : false,
});

const submit = () => {
    form.put(route("tracks.update", { track: props.track }));
};
</script>

<template>
    <Head title="Update track" />
    <HeaderLayout>
        <template #title> Update {{ track.title }} </template>
        <template #action> </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-y-8">
                <div>
                    <label for="title"> Title </label>
                    <input
                        type="text"
                        v-model="form.title"
                        :class="{ 'border-red-500': form.errors.title }"
                        class="form-control"
                        placeholder="Title"
                        id="title"
                    />
                    <p
                        v-if="form.errors.title"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.title }}
                    </p>
                </div>
                <div>
                    <label for="artist"> Artist </label>
                    <input
                        type="text"
                        v-model="form.artist"
                        :class="{ 'border-red-500': form.errors.title }"
                        class="form-control"
                        placeholder="Artist"
                        id="artist"
                    />
                    <p
                        v-if="form.errors.artist"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.artist }}
                    </p>
                </div>
                <div>
                    <label for="display"> Display </label>
                    <select
                        v-model="form.display"
                        :class="{ 'border-red-500': form.errors.title }"
                        class="form-control"
                        placeholder="Artist"
                        id="display"
                    >
                        <option :value="true">Yes</option>
                        <option :value="false">No</option>
                    </select>
                </div>
                <input
                    type="submit"
                    value="Edit the music"
                    class="bg-blue-500 hover:bg-blue-700 rounded-lg px-4 py-2 text-white font-bold hover:cursor-pointer w-fit"
                />
            </form>
        </template>
    </HeaderLayout>
</template>
