<template>
    <b-navbar>
        <template slot="brand">
            <b-navbar-item tag="div">
                SmartHome
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item  :active="true" tag="inertia-link" :href="route('index')">
                Главная
            </b-navbar-item>
            <b-navbar-item :active="route().has('dashboard.index')" tag="inertia-link" :href="route('dashboard.index')">
                Панель управления
            </b-navbar-item>
        </template>

        <template slot="end">
            <b-navbar-item tag="div">
                <div class="buttons">
                    <inertia-link :href="'#'" class="button is-primary">
                        <strong>Войти</strong>
                    </inertia-link>
                    <inertia-link :href="'#'" class="button is-light">
                        <strong>Регистрация</strong>
                    </inertia-link>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    mounted() {
    }
}
</script>
