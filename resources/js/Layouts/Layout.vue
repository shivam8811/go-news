<script setup>
    import TheFooter from '@/Layouts/TheFooter.vue';
    import BaseButtonComponent from '@/Components/UI/BaseButtonComponent.vue';
    import { Link } from '@inertiajs/vue3'
    import { useCategoryStore } from '@/Stores/category.js';
    import { storeToRefs } from 'pinia';

    const categoryStore = useCategoryStore();
    const { getAllCategories } = categoryStore;
    const { selectedCategory } = storeToRefs(categoryStore);
</script>

<template>
    <v-app>
        <v-app-bar class="text-white" :color="`var(--color-primary)`">
            <v-app-bar-title>
                <Link href="/" as="button">goNEWS</Link>
            </v-app-bar-title>
            <v-select
                label="Category"
                v-model="selectedCategory"
                :items="getAllCategories()"
                item-title="name"
                item-value="matchcode"
                variant="underlined"
                density="compact"
                hide-details
                max-width="200"
            ></v-select>
            <v-btn icon="mdi-account"></v-btn>
            <base-button-component href="/login">
                Login
            </base-button-component>
            <base-button-component href="/register">
                Signup
            </base-button-component>
        </v-app-bar>

        <v-main>
            <v-container>
                <slot></slot>
            </v-container>
        </v-main>

        <v-footer class="d-flex flex-column pa-0">
            <TheFooter />
        </v-footer>
    </v-app>
</template>
