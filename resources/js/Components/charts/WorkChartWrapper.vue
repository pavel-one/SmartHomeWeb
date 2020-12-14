<template>
    <div class="card">
        <div class="card-content">
            <slot></slot>
            <div class="tabs">
                <div class="item"
                     :class="{active: item.active}"
                     @click="changeDay(index)"
                     v-for="(item, index) in tabs">
                    За {{item.day}}
                    <span v-if="item.day === 1">день</span>
                    <span v-else>дней</span>
                </div>
            </div>
            <work-chart
                @loadeddata="loaded"
                @load="load = true"
                :day="day"
                :url="url"
            ></work-chart>
            <p class="has-text-centered">Всего за это время: <b>{{all}} {{legend}}</b></p>
            <p class="has-text-centered has-text-grey">Обновление происходит каждые 5 минут</p>
            <b-loading :is-full-page="false" v-model="load"></b-loading>
        </div>
    </div>
</template>

<script>
import WorkChart from "./WorkChart";

export default {
    components: {WorkChart},
    props: ['url', 'legend'],
    data() {
        return {
            load: false,
            all: 0,
            day: 1,
            tabs: [
                {
                    active: true,
                    day: 1,
                },
                {
                    active: false,
                    day: 7,
                },
                {
                    active: false,
                    day: 30,
                },
                {
                    active: false,
                    day: 60,
                },
            ]
        }
    },
    methods: {
        changeDay: function (index) {
            this.tabs.map(item => {
                item.active = false;
            });
            this.tabs[index].active = true;
            this.day = this.tabs[index].day;
        },
        loaded: function (event) {
            this.load = false;
            this.all = event.response.all;
        }
    }
}
</script>

<style lang="scss">
.tabs {
    display: flex;
    justify-content: center;
    .item {
        margin: 0 10px;
        cursor: pointer;
        transition: .25s;
        padding: 5px 10px;
        border-radius: 30px;
        &:hover, &.active {
            background: #eeeeee;
        }
    }
}
</style>
