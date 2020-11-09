<template>
    <div>
        <top-bar></top-bar>
        <slot></slot>
    </div>
</template>


<script>
import topBar from '../Components/menu/top-bar'

export default {
    components: {topBar}
}
</script>
