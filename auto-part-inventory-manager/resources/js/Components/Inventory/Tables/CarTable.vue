<script setup>
import Car from "../Rows/CarRow.vue";
import { router } from "@inertiajs/vue3";
import { ref, provide } from "vue";
const props = defineProps(["cars"]);

let currentPage = 1;
const cars = ref(props.cars);
const loading = ref(false);
const carQuery = ref("");
const partQuery = ref("");

provide("partQuery", { partQuery });

async function filter() {
    try {
        const response = await fetch(
            `/inventory?page=${currentPage}&car-query=${carQuery.value}&part-query=${partQuery.value}`,
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );
        const data = await response.json();

        cars.value.data = data.data;
    } catch (error) {
        console.error("Error loading more cars:", error);
    } finally {
        loading.value = false;
    }
}

async function loadMore() {
    loading.value = true;
    currentPage++;
    try {
        const response = await fetch(
            `/inventory?page=${currentPage}&car-query=${carQuery.value}&part-query=${partQuery.value}`,
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );
        const data = await response.json();

        cars.value.data = [...cars.value.data, ...data.data];
    } catch (error) {
        console.error("Error loading more cars:", error);
    } finally {
        loading.value = false;
    }
}
</script>

<template>
    <form @submit.prevent="filter">
        <label>
            Search for a car
            <input v-model="carQuery" type="text" />
        </label>
        <label>
            Search for a part by name
            <input v-model="partQuery" type="text" />
        </label>
        <button>Search</button>
    </form>
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
        <Car v-for="car in cars.data" :key="car.id" :car="car" />
    </table>
    <div class="flex justify-center">
        <button
            v-if="currentPage < cars.last_page"
            @click="loadMore"
            :disabled="loading"
            class="btn btn-primary"
        >
            {{ loading ? "Loading..." : "Load more" }}
        </button>
    </div>
</template>

<style scoped></style>
