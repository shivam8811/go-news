<script setup>
import { computed, ref, toRaw } from 'vue';
import { useCategoryStore } from '@/Stores/category.js';
import { storeToRefs } from 'pinia';

    const props = defineProps({
        newsData: {
            type: Array,
            default: null,
        }
    })

    const categoryStore = useCategoryStore();
    const { addCategory } = categoryStore;
    const { selectedCategory } = storeToRefs(categoryStore);
    addCategoryToStore();

    function addCategoryToStore() {
        for (const data of props.newsData) {
            for (const category of data.categories) {
                addCategory(toRaw(category));
            }
        }
    }

    const filteredNews = computed(() => {
        if (selectedCategory.value === 'all') {
            return props.newsData;
        }

        return props.newsData.filter((news) => {
            return news.categories.some((category) => category.name === selectedCategory.value);
        });
    });

    const page = ref(1)

    async function getMoreData() {
        try {
            const response = await axios.get('/get-more-data', {
                params: {
                    page: page.value
                }
            });
            return response.data;
        } catch (error) {
            console.error('Error fetching data:', error);
            return [];
        }
    }

    async function loadMore({ done }) {
        page.value++;
        const result = await getMoreData();
        props.newsData.push(...result.newsData);
        addCategoryToStore();
        if (result.hasNoMoreData) {
            done('empty')
            return
        }
        done('ok')
    }
</script>

<template>
<!--        <pre>{{ filteredNews }}</pre>-->
    <v-infinite-scroll @load="loadMore">
        <v-container>
            <v-row>
                <v-col
                    v-for="news in filteredNews"
                    :key="news.id"
                    cols="12"
                    md="4"
                >
                    <base-card-component :href="news.url">
                        <v-img
                            height="200px"
                            :src="news.image_url"
                            lazy-src="https://picsum.photos/id/11/100/60"
                        >
                            <template #error>
                                <v-img
                                    class="mx-auto"
                                    height="300"
                                    max-width="500"
                                    src="https://picsum.photos/500/300?image=232"
                                ></v-img>
                            </template>

                            <template #placeholder>
                                <div class="d-flex align-center justify-center fill-height">
                                    <v-progress-circular
                                        color="grey-lighten-4"
                                        indeterminate
                                    ></v-progress-circular>
                                </div>
                            </template>
                        </v-img>

                        <v-card-title class="wrap-title">
                            {{ news.title }}
                        </v-card-title>

                        <v-card-text>
                            {{ news.description }}
                        </v-card-text>

                        <v-card-subtitle class="text-right">
                            <small>{{ news.source }}</small>
                            <br>
                            <small>{{ news.published_at }}</small>
                        </v-card-subtitle>
                    </base-card-component>
                </v-col>
            </v-row>
        </v-container>

        <template v-slot:empty>
            <v-alert type="warning">No more items!</v-alert>
        </template>
    </v-infinite-scroll>
</template>

<style scoped>
    .wrap-title {
        white-space: normal;
        line-height: 1.2;
        font-size: 1rem;
        font-weight: bold;
    }
</style>
