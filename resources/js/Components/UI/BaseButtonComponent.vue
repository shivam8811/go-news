<script setup>
    import { router } from '@inertiajs/vue3';

    const emit = defineEmits(['click']);
    const props = defineProps({
        href: {
            type: String,
            default: null,
        },
    })

    const handleClick = () => {
        if (props.href) {
            router.visit(props.href);
        } else {
            emit('click');
        }
    };
</script>

<template>
    <v-btn class="base-button" @click="handleClick">
        <slot></slot>
    </v-btn>
</template>

<style scoped>
    .base-button {
        border: 1px solid transparent;
    }
    .base-button:hover {
        border: 1px solid white;
    }
</style>
