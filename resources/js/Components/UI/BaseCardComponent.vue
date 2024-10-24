<script setup>
defineProps({
    href: {
        type: String,
        default: null,
    }
})
</script>

<template>
    <v-card max-width="350" min-height="400" hover :href="href" rounded="lg" target="_blank">
        <slot></slot>
    </v-card>
</template>

<style scoped>

</style>
