<script setup>
defineProps({
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'text',
    },
    prependInnerIcon: {
        type: String,
        default: '',
    },
    appendInnerIcon: {
        type: String,
        default: '',
    },
})
</script>

<template>
    <v-text-field
        :label="label"
        :type="type"
        :prepend-inner-icon="prependInnerIcon"
        :append-inner-icon="appendInnerIcon"
        density="comfortable"
        variant="outlined"
        hide-details
    ></v-text-field>
</template>
