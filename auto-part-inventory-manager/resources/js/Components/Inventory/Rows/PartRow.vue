<script setup>
import dayjs from "dayjs";
import { ref, watchEffect } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["part"]);

const isEditing = ref(false);
const submitErrors = ref();
const part = ref({});

let createdAt = dayjs(props.part.created_at).format("YYYY-MM-DD HH:mm");
let updatedAt = dayjs(props.part.updated_at).format("YYYY-MM-DD HH:mm");

watchEffect(() => {
    createdAt = dayjs(props.part.created_at).format("YYYY-MM-DD HH:mm");
    updatedAt = dayjs(props.part.updated_at).format("YYYY-MM-DD HH:mm");
    part.value = {
        ...props.part,
        createdAt: createdAt,
        updatedAt: updatedAt,
    };
});

function changeEditing() {
    isEditing.value = !isEditing.value;
}

function deletePart() {
    if (confirm("Are you sure?")) {
        router.delete(route("inventory.part.destroy", props.part.id));
    }
}

function updatePart() {
    if (confirm("Are you sure?")) {
        router.put(route("inventory.part.update", props.part.id), part.value, {
            onSuccess: () => {
                isEditing.value = false;
                submitErrors.value = null;
            },
            onError: (errors) => {
                submitErrors.value = errors;
            },
        });
        changeEditing();
    }
}

function revertPart() {
    part.value = {
        ...props.part,
        createdAt: createdAt,
        updatedAt: updatedAt,
    };
    changeEditing();
}
</script>

<template>
    <!-- Non-editing Row -->
    <tr v-if="!isEditing" class="align-middle">
        <td>{{ part.name }}</td>
        <td>{{ part.serialnumber }}</td>
        <td>{{ part.createdAt }}</td>
        <td>{{ part.updatedAt }}</td>
        <td>
            <button @click="deletePart" class="btn btn-danger btn-sm mr-2">
                Delete
            </button>
            <button @click="changeEditing" class="btn btn-warning btn-sm">
                Edit
            </button>
        </td>
    </tr>

    <!-- Editing Row -->
    <tr v-else class="align-middle">
        <td>
            <input
                v-model="part.name"
                type="text"
                class="form-control form-control-sm"
            />
        </td>
        <td>
            <input
                v-model="part.serialnumber"
                type="text"
                class="form-control form-control-sm"
            />
        </td>
        <td>{{ part.createdAt }}</td>
        <td>{{ part.updatedAt }}</td>
        <td>
            <button @click="updatePart" class="btn btn-success btn-sm mr-2">
                Confirm
            </button>
            <button @click="revertPart" class="btn btn-secondary btn-sm">
                Revert
            </button>
        </td>
    </tr>

    <!-- Error Row -->
    <tr v-if="submitErrors">
        <td colspan="5">
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
</template>
