<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">Мои устройства</h1>
            <h2 class="subtitle">Тут вы можете просмотреть список своих устройств, а также управлять ими</h2>
        </template>
        <br>
        {{devices}}
        <div class="list-devices">
            <device :device="deivice" v-for="deivice in devices" :key="deivice.id">

            </device>
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

export default {
    props: ['title', 'devices'],
    components: {layout, device},
    metaInfo() {
        return {
            title: this.title
        }
    },
}
</script>
