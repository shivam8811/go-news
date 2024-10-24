<script setup>

import BaseTextFieldComponent from '@/Components/UI/BaseTextFieldComponent.vue';
import BaseButtonComponent from '@/Components/UI/BaseButtonComponent.vue';
import { ref } from 'vue';
const fields = ref({
    email: '',
    password: '',
});
function submitForm() {
    console.log('submitForm');
}
</script>

<template>
<v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent="submitForm">
        <div class="d-flex flex-column ga-2">
            <div>
                <BaseTextFieldComponent
                    label="Email"
                    type="email"
                    v-model="fields['email']"
                    prepend-inner-icon="mdi-email"
                />
<!--                <ErrorMessage v-if="errors.email" :message="errors.email" />-->
            </div>

            <div>
                <BaseTextFieldComponent
                    label="Password"
                    type="password"
                    v-model="fields['password']"
                    prepend-inner-icon="mdi-lock"
                />
<!--                <ErrorMessage v-if="errors.password" :message="errors.password" />-->
            </div>
        </div>

        <div class="d-flex flex-column mt-5">
            <base-button-component>
                Login
            </base-button-component>
        </div>
    </v-form>
</v-sheet>
</template>

<style scoped>

</style>
