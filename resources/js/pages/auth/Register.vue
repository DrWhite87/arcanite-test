<template>
    <v-container fluid class="fill-height justify-center">
        <v-sheet width="400" class="mx-auto">
            <v-card>
                <v-toolbar>
                    <v-toolbar-title class="text-grey-darken-3">Регистрация</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent>
                        <v-text-field
                            bg-color="white"
                            v-model="form.name"
                            label="Логин"
                            autofocus
                            :error="!!validationErrors.name && validationErrors.name.length"
                            :error-messages="validationErrors.name"
                            @focus="validationErrors.name = []"
                        ></v-text-field>
                        <v-text-field
                            bg-color="white"
                            v-model="form.email"
                            type="email"
                            label="Email"
                            :error="!!validationErrors.email && validationErrors.email.length"
                            :error-messages="validationErrors.email"
                            @focus="validationErrors.email = []"
                        ></v-text-field>
                        <v-text-field
                            bg-color="white"
                            v-model="form.phone"
                            label="Телефон"
                            :error="!!validationErrors.phone && validationErrors.phone.length"
                            :error-messages="validationErrors.phone"
                            @focus="validationErrors.phone = []"
                        ></v-text-field>
                        <v-text-field
                            bg-color="white"
                            v-model="form.password"
                            type="password"
                            label="Пароль"
                            :error="!!validationErrors.password && validationErrors.password.length"
                            :error-messages="validationErrors.password"
                            @focus="validationErrors.password = []"
                        ></v-text-field>
                        <v-text-field
                            bg-color="white"
                            v-model="form.password_confirmation"
                            type="password"
                            label="Пароль"
                            :error="!!validationErrors.password_confirmation && validationErrors.password_confirmation.length"
                            :error-messages="validationErrors.password_confirmation"
                            @focus="validationErrors.password_confirmation = []"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <router-link :to="{name:'login'}" class="text-blue">Войти!</router-link>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="blue" @click="register">{{ processing ? "Подождите" : "Регистрация" }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-sheet>
    </v-container>
</template>

<script>
import {useAuthStore} from '@/store/auth';
import {reactive, ref} from 'vue';

export default {
    name: 'Register',
    setup() {
        const AuthStore = useAuthStore();

        const form = reactive({
            name: "",
            email: "",
            phone: "",
            password: "",
            password_confirmation: ""
        });

        const validationErrors = ref({});
        const processing = ref(false);

        const register = async () => {
            processing.value = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/register', form).then(response => {
                validationErrors.value = {};
                AuthStore.login({email: form.email, password: form.password});
            }).catch(({response}) => {
                if (response.status === 422) {
                    validationErrors.value = response.data.errors;
                } else {
                    validationErrors.value = {};
                }
            }).finally(() => {
                processing.value = false;
            })
        }

        return {
            form,
            validationErrors,
            processing,
            register
        }
    }
}
</script>
