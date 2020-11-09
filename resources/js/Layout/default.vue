<template>
    <div>
        <top-bar></top-bar>
        <div class="container">
            <slot></slot>
        </div>
    </div>
</template>


<script>
import topBar from '../Components/menu/top-bar'

export default {
    components: {topBar},
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
