<script setup>

import BaseTextFieldComponent from '@/Components/UI/BaseTextFieldComponent.vue';
import BaseButtonComponent from '@/Components/UI/BaseButtonComponent.vue';
import { ref } from 'vue';
const fields = ref({
    firstName: '',
    middleName: '',
    lastName: '',
    email: '',
    phone: '',
    password: '',
    confirmPassword: '',
});
</script>

<template>
<v-card variant="flat">
    <v-card-text>
        <v-row>
            <v-col cols="12" md="4">
                <BaseTextFieldComponent label="First name*" v-model.trim="fields['firstName']" />
<!--                <ErrorMessage v-if="errors.firstName" :message="errors.firstName" />-->
            </v-col>

            <v-col cols="12" md="4">
                <BaseTextFieldComponent label="Middle name" v-model.trim="fields['middleName']" />
            </v-col>

            <v-col cols="12" md="4">
                <BaseTextFieldComponent label="Last name*" v-model.trim="fields['lastName']" />
<!--                <ErrorMessage v-if="errors.lastName" :message="errors.lastName" />-->
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" md="6">
                <BaseTextFieldComponent
                    label="E-Mail*"
                    type="email"
                    v-model.trim="fields['email']"
                    prepend-inner-icon="mdi-email"
                />
<!--                <ErrorMessage v-if="errors.email" :message="errors.email" />-->
            </v-col>

            <v-col cols="12" md="6">
                <BaseTextFieldComponent
                    label="Phone"
                    type="tel"
                    v-model.trim="fields['phone']"
                    prepend-inner-icon="mdi-phone"
                />
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" md="6">
                <BaseTextFieldComponent
                    label="Password*"
                    type="password"
                    v-model="fields['password']"
                    prepend-inner-icon="mdi-lock"
                />
<!--                <ErrorMessage v-if="errors.password" :message="errors.password" />-->
            </v-col>

            <v-col cols="12" md="6">
                <BaseTextFieldComponent
                    label="Confirm password*"
                    type="password"
                    v-model="fields['confirmPassword']"
                    prepend-inner-icon="mdi-lock"
                />
<!--                <ErrorMessage v-if="errors.confirmPassword" :message="errors.confirmPassword" />-->
            </v-col>
        </v-row>
        <small class="text-caption text-medium-emphasis">*indicates required field</small>
    </v-card-text>

    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="outlined" color="blue">
            Signup
            <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
    </v-card-actions>
</v-card>
</template>

<style scoped>

</style>
