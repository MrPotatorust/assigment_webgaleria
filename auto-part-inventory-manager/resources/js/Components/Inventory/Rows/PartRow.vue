<script setup>
import dayjs from "dayjs";
import { ref, watchEffect } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["part"]);

const isEditing = ref(false);
const submitErrors = ref();
const part = ref({});

const createdAt = dayjs(props.part.created_at).format("YYYY-MM-DD HH:mm");
const updatedAt = dayjs(props.part.updated_at).format("YYYY-MM-DD HH:mm");

watchEffect(() => {
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
        router.delete(route("inventory/part.destroy", props.part.id));
    }
}

function updatePart() {
    if (confirm("Are you sure?")) {
        router.put(route("inventory/part.update", props.part.id), part.value, {
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
    <tr v-if="!isEditing">
        <td>
            {{ part.name }}
        </td>
        <td>{{ part.serialnumber }}</td>
        <td>{{ part.createdAt }}</td>
        <td>{{ part.updatedAt }}</td>
        <td><button @click="deletePart">Delete</button></td>
        <td><button @click="changeEditing">Edit</button></td>
    </tr>
    <tr v-else>
        <td>
            <input v-model="part.name" type="text" />
        </td>
        <td>
            <input v-model="part.serialnumber" type="text" />
        </td>
        <td>{{ part.createdAt }}</td>
        <td>{{ part.updatedAt }}</td>
        <td><button @click="updatePart">Confirm</button></td>
        <td><button @click="revertPart">Revert</button></td>
    </tr>
</template>
