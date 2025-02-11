<script setup>
import PartRow from "../Rows/PartRow.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["car"]);

const createErrors = ref();
const success = ref(false);

const isCreating = ref(false);
const newPart = ref({
    name: "",
    serialnumber: "",
    car_id: props.car.id,
});

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

        // Append new cars to existing list
        props.parts.data = [...props.parts.data, ...data.data];
        props.parts.next_page_url = data.next_page_url;
    } catch (error) {
        console.error("Error loading more parts:", error);
    }
}

function changeAddingPart() {
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
                <tr class="font-italic">
                    <th>Part name</th>
                    <th>Serial number</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Controls</th>
                </tr>
                <tr v-if="!isCreating">
                    <td colspan="100%">
                        <button @click="changeAddingPart" class="border 2">
                            Add part
                        </button>
                    </td>
                </tr>
                <tr v-else>
                    <td>
                        <input v-model="newPart.name" type="text" />
                    </td>
                    <td>
                        <input v-model="newPart.serialnumber" type="text" />
                    </td>
                    <td><button @click="handleCreate">Submit</button></td>
                    <td><button @click="handleCancel">Cancel</button></td>
                </tr>
                <tr v-if="createErrors">
                    <ul>
                        <li v-for="error in createErrors">{{ error }}</li>
                    </ul>
                </tr>
                <tr v-if="success">
                    <p class="text-green-500">Successfully created a part.</p>
                </tr>
                <PartRow
                    v-for="part in props.car.parts"
                    :key="part.id"
                    :part="part"
                />
            </table>
            <button
                v-if="currentPage < props.parts.last_page"
                @click="loadMore"
            >
                Load more
            </button>
        </td>
    </tr>
</template>
