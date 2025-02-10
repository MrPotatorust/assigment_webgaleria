<script setup>
import Part from "./PartRow.vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import PartTable from "../Tables/PartTable.vue";
import dayjs from "dayjs";
const props = defineProps(["car"]);

const isShown = ref(false);
const isEditing = ref(false);

const createdAt = dayjs(props.car.created_at).format("YYYY-MM-DD HH:mm");
const updatedAt = dayjs(props.car.updated_at).format("YYYY-MM-DD HH:mm");

const editedCar = ref({
    ...props.car,
    createdAt: createdAt,
    updatedAt: updatedAt,
});

function deleteCar() {
    if (confirm("Are you sure?")) {
        router.delete(route("inventory.destroy", props.car.id));
    }
}

function changeShown() {
    isShown.value = !isShown.value;
}

function changeEditing() {
    isEditing.value = !isEditing.value;
}

function updateCar() {
    if (confirm("Are you sure?")) {
        router.put(route("inventory.update", props.car.id), editedCar.value, {
            onSuccess: () => {
                isEditing.value = false;
            },
        });
        changeEditing();
    }
}

function revertCar() {
    editedCar.value = {
        ...props.car,
        createdAt: createdAt,
        updatedAt: updatedAt,
    };
    changeEditing();
}
</script>

<template>
    <thead>
        <tr v-if="!isEditing" class="text-left">
            <td>
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
            </td>
            <td>{{ editedCar.id }}</td>
            <td>
                {{ editedCar.name }}
            </td>
            <td>
                {{ editedCar.registration_number }}
            </td>
            <td>{{ editedCar.is_registered }}</td>
            <td>
                {{ editedCar.createdAt }}
            </td>
            <td>
                {{ editedCar.updatedAt }}
            </td>
            <td>
                <button @click="deleteCar">Delete</button>
            </td>
            <td>
                <button @click="changeEditing">Edit</button>
            </td>
        </tr>
        <tr v-else class="text-left">
            <td>
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
            </td>
            <td>
                {{ props.car.id }}
            </td>
            <td>
                <input type="text" v-model="editedCar.name" />
            </td>
            <td>
                <input type="text" v-model="editedCar.registration_number" />
            </td>
            <td>
                <input type="text" v-model="editedCar.is_registered" />
            </td>
            <td>
                {{ editedCar.createdAt }}
            </td>
            <td>
                {{ editedCar.updatedAt }}
            </td>
            <td>
                <button @click="updateCar">Confirm</button>
            </td>
            <td>
                <button @click="revertCar">Revert</button>
            </td>
        </tr>
    </thead>
    <PartTable v-if="isShown" :car="car" />
</template>
