<template>
    <v-container fluid class="fill-height justify-center">
        <v-sheet width="400" class="mx-auto">
            <v-card>
                <v-toolbar>
                    <v-toolbar-title class="text-grey-darken-3">Авторизация</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent @keypress.enter="login">
                        <v-text-field
                            bg-color="white"
                            v-model="form.email"
                            type="email"
                            label="Email"
                            autofocus
                            :error-messages="validationErrors.email"
                            @focus="validationErrors.email = []"
                        ></v-text-field>
                        <v-text-field
                            bg-color="white"
                            v-model="form.password"
                            type="password"
                            label="Password"
                            :error-messages="validationErrors.password"
                            @focus="validationErrors.password = []"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                        <router-link :to="{name:'register'}" class="text-blue">Зарегистрироваться</router-link>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="blue" @click="login">Войти</v-btn>
                </v-card-actions>
            </v-card>
        </v-sheet>
    </v-container>
</template>

<script>
import {useAuthStore} from '@/store/auth';
import {reactive, ref} from 'vue';

export default {
    name: "Login",
    setup() {
        const AuthStore = useAuthStore();

        const form = reactive({
            email: "",
            password: ""
        });

        const validationErrors = ref({});
        const processing = ref(false);

        const login = async () => {
            processing.value = true;
            await AuthStore.login(form).catch(({response}) => {
                if (response.status === 422) {
                    validationErrors.value = response.data.errors;
                } else {
                    validationErrors.value = {}
                }
            }).finally(() => {
                processing.value = false;
            });
        }

        return {
            form,
            validationErrors,
            processing,
            login
        }
    }
}
</script>
