<template>
    <div class="columns my-1 is-multiline">
        <menu-item v-for="item in menu"
                   :icon="item.icon"
                   :name="item.name"
                   :key="item.id"
                   :description="item.description"
                   :link="item.link"></menu-item>
    </div>
</template>

<script>
import menuItem from './item/profile-menu-item';

export default {
    components: {menuItem},
    data() {
        return {
            menu: [{
                id: 1,
                icon: 'devices',
                name: 'Устройства',
                link: this.route('dashboard.devices'),
                description: 'Список ваших устройств онлайна и настроек'
            },{
                id: 2,
                icon: 'account',
                name: 'Профиль',
                link: this.route('dashboard.profile'),
                description: 'Редактирование профиля пользователя, генерация токена и др.'
            },{
                id: 3,
                icon: 'message-alert',
                name: 'События',
                link: this.route('dashboard.profile'),
                description: 'Все события которые происходили с вашими устройствами'
            }]
        }
    }
}
</script>

<style lang="scss">
    .column {
        min-width: 300px;
    }
</style>
