<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">Мои устройства</h1>
            <h2 class="subtitle">Тут вы можете просмотреть список своих устройств, а также управлять ими</h2>
        </template>
        <breadcrumbs :map="breadcrumbs"></breadcrumbs>
        <div class="list-devices">
            <device :device="deivice" v-for="deivice in devices" :key="deivice.id">

            </device>
            <b-loading :is-full-page="false" v-model="load"></b-loading>
        </div>
    </layout>
</template>

<style lang="scss" scoped>
.list-devices {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}
</style>

<script>
import layout from "../Layout/default";
import device from "../Components/device/item";
import Breadcrumbs from "../Components/menu/breadcrumbs";

export default {
    props: ['title'],
    components: {Breadcrumbs, layout, device},
    metaInfo() {
        return {
            title: this.title
        }
    },
    data() {
        return {
            load: true,
            devices: [],
            breadcrumbs: [
                {
                    name: 'Панель управления',
                    route: 'dashboard.index'
                },
                {
                    name: 'Устройства',
                },
            ]
        }
    },
    mounted() {
        this.getDevices();
        setInterval(() => {
            this.getDevices();
        }, 3000);
    },
    methods: {
        getDevices: function () {
            this.$http.get(this.route('dashboard.api.devices'))
                .then(response => {
                    this.devices = response.data;
                    this.load = false;
                });
        }
    }
}
</script>
