<template>
    <div>
        <top-bar></top-bar>
        <section v-if="hero" class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <slot name="hero"></slot>
                </div>
            </div>
        </section>
        <div class="container">
            <div :style="cssContainer">
                <slot></slot>
            </div>
        </div>
    </div>
</template>


<script>
import topBar from '../Components/menu/top-bar'

export default {
    components: {topBar},
    props: {
        hero: {
            type: Boolean,
            default: false
        },
        cssContainer: Object
    },
    mounted() {
    },
    updated() {
        for (let key in this.$page.props.errors) {
            let errorMessage = this.$page.props.errors[key];
            this.$buefy.notification.open({
                duration: 5000,
                message: errorMessage,
                position: 'is-top-right',
                type: 'is-danger',
                hasIcon: true
            })
        }
    }
}
</script>
