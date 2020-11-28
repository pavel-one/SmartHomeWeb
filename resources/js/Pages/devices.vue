<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">Мои устройства</h1>
            <h2 class="subtitle">Тут вы можете просмотреть список своих устройств, а также управлять ими</h2>
        </template>

        {{ this.devices }}
    </layout>
</template>

<script>
import layout from "../Layout/default";

export default {
    props: ['title', 'devices'],
    components: {layout},
    metaInfo() {
        return {
            title: this.title
        }
    },
}
</script>
