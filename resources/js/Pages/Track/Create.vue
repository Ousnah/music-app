<script setup>
import { Head, useForm } from "@inertiajs/vue3";

defineProps({});

const form = useForm({
    title: "",
    artist: "",
    image: null,
    music: null,
    display: true,
});

const submit = () => {
    form.post(route("tracks.store"));
};
</script>

<template>
    <Head title="Add track" />
    <HeaderLayout>
        <template #title> Add a track </template>
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
                    <label for="image"> Picture </label>
                    <input
                        @input="
                            form.image = $event.target.files[0];
                            console.log(form.image);
                        "
                        type="file"
                        class="form-control"
                        placeholder="Image"
                        id="image"
                        accept="image/*"
                    />
                    <p
                        v-if="form.errors.image"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.image }}
                    </p>
                </div>

                <div>
                    <label for="music"> Music file </label>
                    <input
                        type="file"
                        @input="form.music = $event.target.files[0]"
                        class="form-control"
                        id="music"
                        placeholder="Music"
                        accept="audio/*"
                    />
                    <p
                        v-if="form.errors.music"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.music }}
                    </p>
                </div>

                <div>
                    <label for="display">Should be displayed ? </label>
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
                    <p
                        v-if="form.errors.display"
                        class="text-red-500 text-xs italic"
                    >
                        {{ form.errors.display }}
                    </p>
                </div>

                <input
                    type="submit"
                    value="Add the music"
                    class="bg-blue-500 hover:bg-blue-700 rounded-lg px-4 py-2 text-white font-bold hover:cursor-pointer w-fit"
                />
            </form>
            <div
                v-if="form.processing"
                class="w-96 h-8 bg-slate-50 border-black"
            >
                <div
                    class="w-0 h-full bg-blue-400"
                    :class="w - [form.progress + '%']"
                ></div>
            </div>
        </template>
    </HeaderLayout>
</template>
