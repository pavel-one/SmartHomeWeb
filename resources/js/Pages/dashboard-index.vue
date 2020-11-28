<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">Личный кабинет</h1>
            <h2 class="subtitle">{{$page.props.user.name}} #{{$page.props.user.id}}</h2>
        </template>
        <nav class="level my-2">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Устройств</p>
                    <p class="title">5</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Событий</p>
                    <p class="title">5,273 <span class="has-text-danger">+5</span></p>
                </div>
            </div>
        </nav>
        <profile-menu></profile-menu>
    </layout>
</template>

<script>
import layout from '../Layout/default'
import profileMenu from '../Components/menu/profile-menu'

export default {
    props: ['title'],
    components: {layout, profileMenu},
    metaInfo() {
        return {
            title: this.title
        }
    },
}
</script>
