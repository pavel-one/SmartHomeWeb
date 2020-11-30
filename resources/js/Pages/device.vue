<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">{{device.name}}</h1>
            <h2 class="subtitle" :class="{is_online: device.online}">
                <span></span> {{device.type}}
            </h2>
        </template>
        {{device}}
    </layout>
</template>

<script>
import layout from "../Layout/default";

export default {
    components: {layout},
    props: ['device'],
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>

<style scoped lang="scss">
    .subtitle {
        display: flex;
        align-items: center;
        span {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            overflow: hidden;
            background: darkred;
            display: block;
            margin-right: 10px;
        }
        &.is_online {
            span {
                background: green;
            }
        }
    }
</style>
