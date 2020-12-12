<template>
    <layout :hero="true">
        <template v-slot:hero>
            <h1 class="title">Редактировать профиль</h1>
            <h2 class="subtitle">{{$page.props.user.name}}</h2>
        </template>
        <breadcrumbs :map="breadcrumbs"></breadcrumbs>
        <p class="py-3">Вы можете изменить данные своего профиля или удалить его.</p>
        <form class="my-3" @submit.prevent="submit">
            <b-field :type="errors.name ? 'is-danger' : ''" :message="errors.name" label-position="on-border"
                     label="Имя">
                <b-input type="text" v-model="form.name" maxlength="30"></b-input>
            </b-field>
            <b-field :type="errors.email ? 'is-danger' : ''" :message="errors.email" label-position="on-border"
                     label="Email">
                <b-input type="email" v-model="form.email" maxlength="30"></b-input>
            </b-field>
            <b-field :type="errors.token ? 'is-danger' : ''" :message="errors.token" label-position="on-border"
                     label="Токен">
                <b-input disabled="true" type="text" v-model="form.token"></b-input>
                <div class="buttons">
                    <b-button type="is-primary is-light" @click="token">
                        <b-icon
                            icon="refresh"
                        >
                        </b-icon>
                    </b-button>
                    <b-button :disabled="isCopy" type="is-primary is-light" @click="copy">
                        <b-icon
                            :icon="isCopy ? 'check' : 'content-copy'"
                        >
                        </b-icon>
                    </b-button>
                </div>

            </b-field>
            <b-field :type="errors.password ? 'is-danger' : ''" :message="errors.password" label-position="on-border"
                     label="Новый пароль">
                <b-input type="password" v-model="form.password"></b-input>
            </b-field>

            <div class="buttons">
                <b-button native-type="submit" type="is-primary">Сохранить</b-button>
                <b-button @click="remove" type="is-danger">Удалить профиль</b-button>
            </div>
        </form>
    </layout>
</template>

<script>
import layout from '../Layout/default'
import Breadcrumbs from "../Components/menu/breadcrumbs";

export default {
    props: ['title', 'errors'],
    components: {Breadcrumbs, layout},
    metaInfo() {
        return {
            title: this.title
        }
    },
    data() {
        return {
            isCopy: false,
            form: {
                email: this.$page.props.user.email,
                name: this.$page.props.user.name,
                password: '',
                token: this.$page.props.user.token,
            },
            breadcrumbs: [
                {
                    name: 'Панель управления',
                    route: 'dashboard.index'
                },
                {
                    name: 'Редактирование профиля',
                },
            ]
        }
    },
    methods: {
        remove: function () {
            this.$buefy.dialog.confirm({
                message: 'Внимание! Вы точно хотите удалить свой профиль и все связанные с ним данные? После подтверждения, восстановить их будет невозможно!',
                onConfirm: () => {
                    this.$inertia.delete(this.route('dashboard.delete'));
                },
                cancelText: 'Закрыть'
            })
        },
        submit: function () {
            if (this.form.password) {
                this.$buefy.dialog.confirm({
                    message: 'Ваш пароль будет изменен на новый, вы уверены? Если вы не хотите менять пароль, вернитесь назад и очистите поле "новый пароль"',
                    onConfirm: () => {
                        this.$inertia.post(this.route('dashboard.update'), this.form);
                    },
                    cancelText: 'Закрыть'
                })
            } else {
                this.$inertia.post(this.route('dashboard.update'), this.form);
            }
        },
        copy: function () {
            if (this.isCopy) {
                return ;
            }

            this.copyToClipboard(this.$page.props.user.token);
            this.$buefy.notification.open({
                duration: 2000,
                message: 'Скопировано',
                position: 'is-top-right',
                type: 'is-success',
                hasIcon: true
            })
        },
        token: function () {
            this.$buefy.dialog.confirm({
                message: 'Внимание! Будет сгенерирован новый токен, а это значит что все ваши устройства работающие сейчас, работать перестанут, продолжить?',
                onConfirm: () => {
                    this.$inertia.get(this.route('dashboard.token'));
                },
                cancelText: 'Закрыть'
            })
        },
        copyToClipboard: function(str) {
            const el = document.createElement('textarea');
            el.value = str;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            this.isCopy = true;
        }
    }
}
</script>
