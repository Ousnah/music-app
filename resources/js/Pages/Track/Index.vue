<script setup>
import { ref, computed } from "vue";
import TrackElement from "@/Components/TrackElement.vue";

const props = defineProps({
    tracks: Array,
});

const tracksRef = ref(props.tracks);
const search = ref("");

const currentTrack = ref(null);
const audio = ref(null);

const filteredTracks = computed(() => {
    return tracksRef.value.filter(
        (track) =>
            track.title.toLowerCase().includes(search.value.toLowerCase()) ||
            track.artist.toLowerCase().includes(search.value.toLowerCase())
    );
});

const active = computed(() => {
    return currentTrack.value && !audio.value.paused;
});

const playMusic = (track) => {
    const url = "/storage/" + track.music;

    if (!currentTrack.value) {
        audio.value = new Audio(url);
        audio.value.play();
    } else if (currentTrack.value !== track.uuid) {
        audio.value.pause();
        audio.value.src = url;
        audio.value.play();
    } else if (!audio.value.paused) {
        audio.value.pause();
    } else {
        audio.value.play();
    }

    currentTrack.value = track.uuid;
};
</script>

<template>
    <Head title="Tracks" />
    <HeaderLayout>
        <template #title> Tracks </template>
        <template #action> </template>
        <template #content>
            <div>
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search..."
                    class="mb-8 rounded-lg w-1/4"
                />
                <ul
                    class="flex flex-wrap gap-8 justify-center"
                    :v-if="filteredTracks.length > 0"
                >
                    <TrackElement
                        v-for="(track, index) in filteredTracks"
                        :key="track.uuid"
                        @click.stop="playMusic(track)"
                        :track="track"
                        :index="index"
                        :active="active && currentTrack === track.uuid"
                        @play="playMusic(track)"
                    />
                </ul>
            </div>
        </template>
    </HeaderLayout>
</template>
