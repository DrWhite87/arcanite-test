<template>
    <v-container fluid>
        <v-sheet width="800" class="mx-auto">
            <v-card>
                <v-toolbar>
                    <v-toolbar-title class="text-grey-darken-3">Профиль</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-row>
                        <v-col>
                            ФИО
                        </v-col>
                        <v-col>
                            {{ user.name }}
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            Email
                        </v-col>
                        <v-col>
                            {{ user.email }}
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            Телефон
                        </v-col>
                        <v-col>
                            {{ user.phone }}
                        </v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            Токен
                        </v-col>
                        <v-col>
                            <template v-if="token">{{ token }}</template>
                            <v-btn v-else @click="getToken">Сгенерировать токен</v-btn>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-sheet>
    </v-container>
</template>

<script>
import {computed, ref} from 'vue';
import {useProfileStore} from "@/store/profile";

export default {
    name: 'Profile',
    setup() {
        const ProfileStore = useProfileStore();
        const user = computed(() => ProfileStore.profile);
        const token = computed(() => ProfileStore.token);

        ProfileStore.fetch();

        const getToken = async () => {
            // await axios.get('/sanctum/csrf-cookie');
            await ProfileStore.getToken();
        };

        return {
            user,
            getToken,
            token
        }
    }
}
</script>
