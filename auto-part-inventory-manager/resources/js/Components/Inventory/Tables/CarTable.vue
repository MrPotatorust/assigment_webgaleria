<script setup>
import Car from "../Rows/CarRow.vue";
import { router } from "@inertiajs/vue3";
import { ref, provide, watchEffect } from "vue";

const props = defineProps(["cars"]);

let currentPage = 1;
const cars = ref(props.cars);
const loading = ref(false);
const carQuery = ref("");
const partQuery = ref("");

provide("partQuery", { partQuery });

watchEffect(() => (cars.value = props.cars));

async function getCars() {
    try {
        const response = await fetch(
            `${route("inventory.index")}?page=${currentPage}&car-query=${
                carQuery.value
            }&part-query=${partQuery.value}`,
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );
        const data = await response.json();

        return data;
    } catch (error) {
        console.log(error);
        return false;
    }
}

async function filter() {
    loading.value = true;
    const response = await getCars();
    if (response) {
        cars.value.last_page = response.last_page;
        cars.value.data = response.data;
        loading.value = false;
    }
}

async function loadMore() {
    loading.value = true;
    currentPage++;

    const response = await getCars();
    if (response) {
        cars.value.data = [...cars.value.data, ...response.data];
        cars.value.last_page = response.last_page;
        loading.value = false;
    }
}
</script>

<template>
    <form @submit.prevent="filter" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Search for a car</label>
                <input v-model="carQuery" type="text" class="form-control" />
            </div>
            <div class="form-group col-md-6">
                <label>Search for a part by name</label>
                <input v-model="partQuery" type="text" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary">Search</button>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th style="width: 5%"></th>
                <th style="width: 5%">#</th>
                <th style="width: 15%">Name</th>
                <th style="width: 15%">Registration number</th>
                <th style="width: 10%">Is registered</th>
                <th style="width: 15%">Created at</th>
                <th style="width: 15%">Updated at</th>
                <th style="width: 15%">Controls</th>
            </tr>
        </thead>
        <Car v-for="car in cars.data" :key="car.id" :car="car" />
    </table>

    <div class="text-center mt-3">
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
