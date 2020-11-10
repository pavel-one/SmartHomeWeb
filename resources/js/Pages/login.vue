<template>
    <layout :css-container="container" :hero="false">
        <template v-slot:hero>
            <h1 class="title">Вход</h1>
            <h2 class="subtitle">Авторизуйтесь, чтобы воспользоваться панелью управления</h2>
        </template>
        <h1 class="title">Вход</h1>
        {{user}}
        <div class="columns">
            <form @submit.prevent="submit" class="column" >
                <b-field :type="errors.email ? 'is-danger' : ''" :message="errors.email" label-position="on-border" label="Email">
                    <b-input type="email" v-model="form.email" maxlength="30"></b-input>
                </b-field>

                <b-field :type="errors.password ? 'is-danger' : ''" :message="errors.password" label-position="on-border" label="Пароль">
                    <b-input type="password" v-model="form.password" maxlength="30"></b-input>
                </b-field>

                <b-button native-type="submit" type="is-primary">Войти</b-button>
            </form>
            <section class="column">
                <h2 class="subtitle">Воспользуйтесь личным кабинетом</h2>
                <div class="content">
                    <p>
                        Войдя в свою панель управления, вы сможете воспользоваться такими услугами, как:
                    </p>
                    <ul>
                        <li>История замеров датчика температуры</li>
                        <li>Проверка состояний и онлайна ESP</li>
                        <li>График изменения температуры</li>
                    </ul>
                </div>
            </section>
        </div>
    </layout>
</template>

<script>
import layout from '../Layout/default'

export default {
    components: {layout},
    props: ['title', 'errors', 'user'],
    metaInfo() {
        return {
            title: this.title
        }
    },
    data() {
        return {
            container: {
                // maxWidth: '500px',
                margin: '10px 0'
            },
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        submit: function () {
            this.$inertia.post(this.route('auth'), {
                email: this.form.email,
                password: this.form.password,
            })
        }
    }
}
</script>
