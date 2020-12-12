<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">{{ device.name }}</h1>
            <h2 class="subtitle">
                <div class="list-props">
                    <div class="prop-item" v-if="device.power">
                        <div class="name">Мощность: </div>
                        <div class="prop">{{device.power}} Вт.</div>
                    </div>
                </div>
            </h2>
        </template>
        <breadcrumbs :map="breadcrumbs"></breadcrumbs>
        {{ device }}
    </layout>
</template>

<script>
import layout from "../Layout/default";
import Breadcrumbs from "../Components/menu/breadcrumbs";
import route from "ziggy-js";

export default {
    components: {Breadcrumbs, layout},
    props: ['device'],
    data() {
        return {
            breadcrumbs: [
                {
                    name: 'Панель управления',
                    route: 'dashboard.index'
                },
                {
                    name: 'Устройства',
                    route: 'dashboard.devices'
                },
                {
                    name: this.device.name
                }
            ]
        }
    },
    methods: {}
}
</script>

<style lang="scss">
    .prop-item {
        display: flex;
        flex-direction: row;
        .name {
            margin-right: 10px;
        }
        .prop {
            font-weight: bold;
        }
    }
</style>
