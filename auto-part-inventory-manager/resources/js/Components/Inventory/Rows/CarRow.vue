<script setup>
import { ref, watchEffect, computed } from "vue";
import { router } from "@inertiajs/vue3";
import dayjs from "dayjs";
import PartTable from "../Tables/PartTable.vue";
const props = defineProps(["car"]);

const isShown = ref(false);
const isEditing = ref(false);
const isCreating = ref(false);
const submitErrors = ref();

const car = ref({});

let createdAt = dayjs(props.car.created_at).format("YYYY-MM-DD HH:mm");
let updatedAt = dayjs(props.car.updated_at).format("YYYY-MM-DD HH:mm");

watchEffect(() => {
    createdAt = dayjs(props.car.created_at).format("YYYY-MM-DD HH:mm");
    updatedAt = dayjs(props.car.updated_at).format("YYYY-MM-DD HH:mm");
    car.value = {
        ...props.car,
        createdAt: createdAt,
        updatedAt: updatedAt,
    };
});

function deleteCar() {
    if (confirm("Are you sure?")) {
        router.delete(route("inventory.car.destroy", props.car.id), {
            preserveScroll: true,
        });
    }
}

function changeShown() {
    isShown.value = !isShown.value;
    isCreating.value = false;
}

function changeEditing() {
    isEditing.value = !isEditing.value;
}

function enableIsCreating() {
    isCreating.value = true;
    isShown.value = true;
}
function disableIsCreating() {
    isCreating.value = false;
}

function updateCar() {
    if (confirm("Are you sure?")) {
        router.put(route("inventory.car.update", props.car.id), car.value, {
            onSuccess: () => {
                isEditing.value = false;
                submitErrors.value = null;
            },
            onError: (errors) => {
                submitErrors.value = errors;
            },
            preserveScroll: true,
        });
        isEditing.value = !isEditing.value;
    }
}

function revertCar() {
    car.value = {
        ...props.car,
        createdAt: createdAt,
        updatedAt: updatedAt,
    };
    changeEditing();
}
</script>

<template>
    <thead>
        <tr v-if="!isEditing" class="align-middle">
            <td class="text-center">
                <button @click="changeShown" class="btn btn-link p-0">
                    <svg
                        v-if="!isShown"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        width="24"
                        height="24"
                        class="text-secondary"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m11.99 16.5 3.75 3.75m0 0 3.75-3.75m-3.75 3.75V3.75H4.49"
                        />
                    </svg>
                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        width="24"
                        height="24"
                        class="text-secondary"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11.99 7.5 8.24 3.75m0 0L4.49 7.5m3.75-3.75v16.499h11.25"
                        />
                    </svg>
                </button>
            </td>
            <td>{{ car.id }}</td>
            <td>{{ car.name }}</td>
            <td>{{ car.registration_number }}</td>
            <td>{{ car.is_registered }}</td>
            <td>{{ car.createdAt }}</td>
            <td>{{ car.updatedAt }}</td>
            <td>
                <button @click="deleteCar" class="btn btn-danger btn-sm mr-2">
                    Delete
                </button>
                <button @click="changeEditing" class="btn btn-warning btn-sm">
                    Edit
                </button>
                <button
                    @click="enableIsCreating"
                    class="btn btn-primary btn-sm"
                >
                    Add part
                </button>
            </td>
        </tr>

        <!-- Editing Row -->
        <tr v-else class="align-middle">
            <td class="text-center">
                <button @click="changeShown" class="btn btn-link p-0"></button>
            </td>
            <td>{{ car.id }}</td>
            <td>
                <input
                    type="text"
                    v-model="car.name"
                    class="form-control form-control-sm"
                />
            </td>
            <td>
                <input
                    type="text"
                    v-model="car.registration_number"
                    class="form-control form-control-sm"
                />
            </td>
            <td>
                <select
                    v-model="car.is_registered"
                    class="form-control form-control-sm"
                >
                    <option value="false">false</option>
                    <option value="true">true</option>
                </select>
            </td>
            <td>{{ car.createdAt }}</td>
            <td>{{ car.updatedAt }}</td>
            <td>
                <button @click="updateCar" class="btn btn-success btn-sm mr-2">
                    Confirm
                </button>
                <button @click="revertCar" class="btn btn-secondary btn-sm">
                    Revert
                </button>
            </td>
        </tr>

        <!-- Error Row -->
        <tr v-if="submitErrors">
            <td colspan="8" class="border-0">
                <ul class="list-unstyled mb-0">
                    <li
                        v-for="error in submitErrors"
                        :key="error"
                        class="text-center text-danger font-weight-bold"
                    >
                        {{ error }}
                    </li>
                </ul>
            </td>
        </tr>
    </thead>
    <PartTable
        v-if="isShown"
        :car="car"
        :isCreating="isCreating"
        @disableIsCreating="disableIsCreating"
    />
</template>
