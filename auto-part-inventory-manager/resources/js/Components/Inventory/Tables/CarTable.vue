<script setup>
import Car from "../Rows/CarRow.vue";
import { router } from "@inertiajs/vue3";
const props = defineProps(["cars"]);

// console.log(props.cars);
let currentPage = 1;

async function loadMore() {
    currentPage++;
    try {
        const response = await fetch(`/inventory?page=${currentPage}`, {
            headers: {
                Accept: "application/json",
            },
        });
        const data = await response.json();

        props.cars.data = [...props.cars.data, ...data.data];
        props.cars.next_page_url = data.next_page_url;
    } catch (error) {
        console.error("Error loading more cars:", error);
    }
}
</script>

<template>
    <table class="w-6xl border-2 border-gray-300">
        <thead class="text-lg">
            <tr class="text-left">
                <td class="w-16 p-2"></td>
                <td class="w-16 p-2">#</td>
                <td class="w-24 p-2">Name</td>
                <td class="w-16 p-2">Registration number</td>
                <td class="w-18 p-2">Is registered</td>
                <td class="w-18 p-2">Created at</td>
                <td class="w-18 p-2">Updated at</td>
                <td class="w-16 p-2">Controls</td>
            </tr>
        </thead>
        <Car v-for="car in props.cars.data" :key="car.id" :car="car" />
    </table>
    <button v-if="currentPage < props.cars.last_page" @click="loadMore">
        Load more
    </button>
</template>
