<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">{{ device.name }}</h1>
            <h2 class="subtitle">
                <div class="list-props">
                    <div class="prop-item" v-if="device.power">
                        <div class="name">Мощность:</div>
                        <div class="prop">{{ device.power }} Вт.</div>
                    </div>
                </div>
            </h2>
        </template>
        <breadcrumbs :map="breadcrumbs"></breadcrumbs>
        {{ device }}
        <hr>
        {{ this.$page.props }}
        <div class="device-dashboard">
            <div class="columns">
                <div class="column">
                    <form method="post" @submit.prevent="saveProps" class="card">
                        <div class="card-content">
                            <h3 class="title">
                                Настройки
                            </h3>
                            <h4 class="subtitle">
                                Настройки устройства
                            </h4>

                            <b-field label="Название">
                                <b-input maxlength="30" v-model="deviceEditable.name"></b-input>
                            </b-field>
                            <b-field label="Мощность устройства (Вт)">
                                <b-numberinput
                                    :max="2000"
                                    :exponential="true"
                                    type="is-light"
                                    controls-rounded
                                    v-model="deviceEditable.power"
                                ></b-numberinput>
                            </b-field>
                            <b-field label="Mac-адрес">
                                <b-input maxlength="30" disabled="true" v-model="deviceEditable.mac"></b-input>
                            </b-field>
                            <b-field label="Мощность сигнала (dBm)">
                                <b-input maxlength="30" disabled="true" v-model="deviceEditable.signal"></b-input>
                            </b-field>
                        </div>
                        <footer class="card-footer">
                            <div class="card-footer-item">
                                <b-button native-type="submit" type="is-primary">Сохранить и обновить</b-button>
                            </div>
                        </footer>
                    </form>
                </div>
                <div class="column">
                    <div class="column">
                        <div class="card">
                            <div class="card-content">
                                <h3 class="title">Потребление</h3>
                                <h4 class="subtitle">Потребление электроэнергии от заданной мощности</h4>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <div class="card-content">
                                <h3 class="title">График работы</h3>
                                <h4 class="subtitle">График работы устройства</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import layout from "../Layout/default";
import Breadcrumbs from "../Components/menu/breadcrumbs";

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
            ],
            deviceEditable: this.device,
            throttle: true,
        }
    },
    methods: {
        saveProps: function () {
            this.$inertia.post(this.route('dashboard.device.update', this.device.id), this.deviceEditable);
        }
    },
    computed: {}
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
