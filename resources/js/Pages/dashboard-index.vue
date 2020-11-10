<template>
    <layout>
        <template v-slot:hero>
            <h1 class="title">Личный кабинет</h1>
            <h2 class="subtitle">{{$page.props.user.name}} #{{$page.props.user.id}}</h2>
        </template>
    </layout>
</template>

<script>
import layout from '../Layout/default'

export default {
    props: ['user', 'title'],
    components: {layout},
    metaInfo() {
        return {
            title: this.title
        }
    },
}
</script>
