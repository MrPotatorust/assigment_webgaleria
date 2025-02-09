<script setup>
import Part from "./PartRow.vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import PartTable from "./PartTable.vue";
import dayjs from "dayjs";
import BaseTable from "./BaseTable.vue";
const car = defineProps(["car"]);

let isShown = ref(false);
let isEditing = ref(false);

function deleteCar() {
    if (confirm("Are you sure?")) {
        router.delete(route("inventory.destroy", car.id));
    }
}

function changeShown() {
    isShown.value = !isShown.value;
}
function changeEditing() {
    isEditing.value = !isEditing.value;
}
</script>

<template>
    <thead>
        <tr class="text-left">
            <th>
                <button v-if="!isShown" class="" @click="changeShown">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m11.99 16.5 3.75 3.75m0 0 3.75-3.75m-3.75 3.75V3.75H4.49"
                        />
                    </svg>
                </button>
                <button v-if="isShown" class="" @click="changeShown">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11.99 7.5 8.24 3.75m0 0L4.49 7.5m3.75-3.75v16.499h11.25"
                        />
                    </svg>
                </button>
            </th>
            <th>{{ car.id }}</th>
            <th scope="col">
                {{ car.name }}
            </th>
            <th>
                {{ car.registration_number }}
            </th>
            <th>{{ car.is_registered }}</th>
            <th>{{ dayjs(car.created_at).format("YYYY-MM-DD HH:mm") }}</th>
            <th>{{ dayjs(car.updated_at).format("YYYY-MM-DD HH:mm") }}</th>
            <td>
                <button @click="deleteCar">Delete</button>
            </td>
            <td>
                <button @click="changeEditing">Edit</button>
            </td>
        </tr>
    </thead>
    <PartTable v-if="isShown" :car="car" />
</template>
