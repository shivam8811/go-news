import { defineStore } from 'pinia'
import { ref } from 'vue';
import utils from '@/utils.js';

export const useCategoryStore = defineStore('category', () => {
    const defaultCategory = {
        id: 0,
        name: 'All',
        matchcode: 'all'
    }

    const selectedCategory = ref(defaultCategory.matchcode);
    const categories = ref([defaultCategory]);

    function getAllCategories() {
        return categories.value;
    }

    function addCategory(category) {
        const exists = categories.value.some(cat => cat.matchcode === category.name);
        if (! exists) {
            categories.value.push(composeCategoryObject(category));
        }
    }

    function composeCategoryObject(category) {
        return {
            id: categories.value.length,
            name: utils.capitalizeFirstLetter(category.name),
            matchcode: category.name
        }
    }

    return {
        getAllCategories,
        addCategory,
        selectedCategory,
    }
})
