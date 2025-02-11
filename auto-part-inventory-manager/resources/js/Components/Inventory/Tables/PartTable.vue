<script setup>
import PartRow from "../Rows/PartRow.vue";
import { onMounted, ref, inject } from "vue";
import { router } from "@inertiajs/vue3";

const { partQuery } = inject("partQuery");
const props = defineProps(["car"]);
const parts = ref({
    data: [],
    last_page: 1,
});

const createErrors = ref();
const success = ref(false);
const loading = ref(false);

const isCreating = ref(false);
const newPart = ref({
    name: "",
    serialnumber: "",
    car_id: props.car.id,
});

let currentPage = 1;

onMounted(async () => {
    try {
        const response = await fetch(
            route("inventory.part.index", props.car.id) +
                `?page=${currentPage}?query=${partQuery}`,
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );
        const data = await response.json();
        parts.value = data;
    } catch (error) {
        console.error("Error loading parts:", error);
    }
});

async function loadMore() {
    if (loading.value) return;
    loading.value = true;
    currentPage++;

    try {
        const response = await fetch(
            route("inventory.part.index", props.car.id) +
                `?page=${currentPage}?query=${partQuery}`,
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );
        const data = await response.json();

        parts.value.data = [...parts.value.data, ...data.data];
    } catch (error) {
        console.error("Error loading more parts:", error);
    } finally {
        loading.value = false;
    }
}

function changeIsCreating() {
    isCreating.value = !isCreating.value;
}

function handleCreate() {
    router.post(route("inventory.part.store"), newPart.value, {
        onSuccess: () => {
            newPart.value = {
                name: "",
                serialnumber: "",
                car_id: props.car.id,
            };
            createErrors.value = null;
            success.value = true;
        },
        onError: (errors) => {
            console.log(errors);
            createErrors.value = errors;
        },
    });
}

function handleCancel() {
    newPart.value = {
        name: "",
        serialnumber: "",
    };
    isCreating.value = false;
}
</script>

<template>
    <tr>
        <td colspan="100%">
            <table class="w-full border-2 text-left">
                <thead>
                    <tr class="font-italic">
                        <th>Part name</th>
                        <th>Serial number</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="!isCreating">
                        <td colspan="100%">
                            <button
                                @click="changeIsCreating"
                                class="border-2 px-4 py-2"
                            >
                                Add part
                            </button>
                        </td>
                    </tr>
                    <tr v-else>
                        <td>
                            <input
                                v-model="newPart.name"
                                type="text"
                                class="border p-2"
                            />
                        </td>
                        <td>
                            <input
                                v-model="newPart.serialnumber"
                                type="text"
                                class="border p-2"
                            />
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <button
                                @click="handleCreate"
                                class="px-4 py-2 bg-green-500 text-white"
                            >
                                Submit
                            </button>
                            <button
                                @click="handleCancel"
                                class="px-4 py-2 bg-gray-500 text-white"
                            >
                                Cancel
                            </button>
                        </td>
                    </tr>
                    <tr v-if="createErrors">
                        <td colspan="100%">
                            <ul class="text-red-500">
                                <li v-for="error in createErrors">
                                    {{ error }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr v-if="success">
                        <td colspan="100%">
                            <p class="text-green-500">
                                Successfully created a part.
                            </p>
                        </td>
                    </tr>
                    <PartRow
                        v-for="part in parts.data"
                        :key="part.id"
                        :part="part"
                    />
                </tbody>
            </table>
            <button
                v-if="currentPage < parts.last_page"
                @click="loadMore"
                :disabled="loading"
            >
                {{ loading ? "Loading..." : "Load more" }}
            </button>
        </td>
    </tr>
</template>
