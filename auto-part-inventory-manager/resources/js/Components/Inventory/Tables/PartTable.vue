<script setup>
import PartRow from "../Rows/PartRow.vue";
import { onMounted, ref, inject, watchEffect } from "vue";
import { router } from "@inertiajs/vue3";

const { partQuery } = inject("partQuery");
const emits = defineEmits(["disableIsCreating"]);
const props = defineProps(["car", "isCreating"]);
const parts = ref({
    data: [],
    last_page: 1,
});

const createErrors = ref();
const success = ref(false);
const loading = ref(false);

const newPart = ref({
    name: "",
    serialnumber: "",
    car_id: props.car.id,
});

let currentPage = 1;

watchEffect(async () => {
    loading.value = true;
    const response = await getParts();
    if (response) {
        parts.value = response;
    }
    loading.value = false;
});

async function getParts() {
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

        return data;
    } catch (error) {
        console.error("Error loading parts:", error);
        return false;
    }
}

async function loadMore() {
    loading.value = true;
    currentPage++;

    const response = await getParts();

    if (response) {
        parts.value.data = [...parts.value.data, ...response.data];
        loading.value = false;
    }
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
            createErrors.value = errors;
        },
        preserveScroll: true,
    });
}

function handleCancel() {
    newPart.value = {
        name: "",
        serialnumber: "",
    };
    emits("disableIsCreating");
}
</script>

<template>
    <tr>
        <td colspan="8" class="p-0 border-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Part name</th>
                        <th>Serial number</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isCreating">
                        <td>
                            <input
                                v-model="newPart.name"
                                type="text"
                                class="form-control form-control-sm"
                            />
                        </td>
                        <td>
                            <input
                                v-model="newPart.serialnumber"
                                type="text"
                                class="form-control form-control-sm"
                            />
                        </td>
                        <td></td>
                        <td></td>
                        <td class="equal-spacing">
                            <button
                                @click="handleCreate"
                                class="btn btn-success btn-sm"
                                style=""
                            >
                                Submit
                            </button>
                            <button
                                @click="handleCancel"
                                class="btn btn-secondary btn-sm"
                            >
                                Cancel
                            </button>
                        </td>
                    </tr>
                    <tr v-if="createErrors">
                        <td colspan="5">
                            <ul class="list-unstyled mb-0">
                                <li
                                    v-for="error in createErrors"
                                    class="text-danger"
                                >
                                    {{ error }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr v-if="success">
                        <td colspan="5">
                            <p class="text-success mb-0">
                                Successfully created a part.
                            </p>
                        </td>
                    </tr>
                    <template v-if="!loading && parts.data.length === 0">
                        <tr>
                            <td colspan="100%" class="text-center text-danger">
                                No parts as of yet!
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <PartRow
                            v-for="part in parts.data"
                            :key="part.id"
                            :part="part"
                        />
                    </template>
                </tbody>
            </table>
            <div class="text-center mt-2">
                <button
                    v-if="currentPage < parts.last_page"
                    @click="loadMore"
                    :disabled="loading"
                    class="btn btn-primary btn-sm"
                >
                    {{ loading ? "Loading..." : "Load more" }}
                </button>
            </div>
        </td>
    </tr>
</template>
