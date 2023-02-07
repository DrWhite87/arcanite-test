<template>
    <v-layout>
        <v-app>
            <v-navigation-drawer
                v-model="drawer"
                temporary
                v-if="authenticated"
            >
                <v-list-item
                    :prepend-avatar="'https://randomuser.me/api/portraits/men/' + viewer.id + '.jpg'"
                    :title="viewer.name"
                ></v-list-item>

                <v-divider></v-divider>

                <v-list
                    density="compact"
                    nav
                    v-for="item in items"
                >
                    <v-list-item
                        :prepend-icon="item.icon"
                        :title="item.title"
                        :value="item.to.name"
                        :to="item.to"
                        :key="item.to.name"
                    ></v-list-item>
                </v-list>
                <v-list
                    density="compact"
                    nav
                >
                    <v-list-item prepend-icon="mdi mdi-logout" @click.prevent="logout">Выйти</v-list-item>
                </v-list>
            </v-navigation-drawer>
            <v-app-bar title="Arcanite">
                <template v-slot:prepend v-if="authenticated">
                    <v-app-bar-nav-icon @click.prevent="drawer = !drawer"></v-app-bar-nav-icon>
                </template>
            </v-app-bar>
            <v-main>
                <router-view></router-view>
            </v-main>
        </v-app>
    </v-layout>
</template>

<script>
import {useAuthStore} from '@/store/auth';
import {ref, computed} from 'vue';

export default {
    name: 'App',
    setup() {
        const AuthStore = useAuthStore();
        const drawer = ref(false);
        const clipped = ref(false);

        const items = [
            {
                icon: 'mdi mdi-account-box',
                title: 'Профиль',
                to: {name: 'profile'},
            },
            {
                icon: 'mdi mdi-cash-sync',
                title: 'Выплаты',
                to: {name: 'payments.index'},
            },
        ];

        return {
            items,
            drawer,
            clipped,
            viewer: computed(() => AuthStore.viewer),
            authenticated: computed(() => AuthStore.authenticated),
            logout: AuthStore.logout
        }
    }
}

</script>
