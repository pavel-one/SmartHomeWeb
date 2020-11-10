<template>
    <b-navbar>
        <template slot="brand">
            <b-navbar-item tag="div">
                SmartHome
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item  :active="false" tag="inertia-link" :href="route('index')">
                Главная
            </b-navbar-item>
            <b-navbar-item tag="inertia-link" :href="route('dashboard.index')">
                Панель управления
            </b-navbar-item>
        </template>

        <template slot="end">
            <b-navbar-item tag="div">
                <div class="buttons">
                    <div v-if="this.$page.props.user">
                        <inertia-link :href="route('dashboard.index')" class="button is-primary">
                            <strong>{{this.$page.props.user.name}}</strong>
                        </inertia-link>
                        <inertia-link :href="route('auth.logout')" class="button is-light">
                            <strong>Выход</strong>
                        </inertia-link>
                    </div>
                    <div v-else>
                        <inertia-link :href="route('auth.index')" class="button is-primary">
                            <strong>Войти</strong>
                        </inertia-link>
                    </div>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
        }
    },
    mounted() {
    }
}
</script>
