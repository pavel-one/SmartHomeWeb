<template>
    <div class="breadcrumbs">
        <div class="bread-item">
            <div>
                <inertia-link :href="route('index')">
                    <b-icon
                        icon="home"
                        size="is-small">
                    </b-icon>
                </inertia-link>
            </div>
        </div>
        <div class="bread-item" v-for="item in map">
            <div v-if="item.route">
                <inertia-link :href="route(item.route)">{{item.name}}</inertia-link>
            </div>
            <div class="bread-last" v-else>
                {{item.name}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        map: {
            type: Array,
            default: [],
        }
    }
}
</script>

<style lang="scss" scoped>
    $border-h: 22px;

    .breadcrumbs {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 10px 0;
        .bread-item {
            display: flex;
            align-items: center;
            margin-right: 12px;
            //box-shadow: 0px 0px 10px rgba(0,0,0,.2);
            a, .bread-last {
                display: block;
                padding: 10px 30px;
                position: relative;
                background: #F3F5FA;
                &:after {
                    content: "";
                    border-top: $border-h solid transparent;
                    border-bottom: $border-h solid transparent;
                    border-left: $border-h solid #F3F5FA;
                    position: absolute;
                    right: -$border-h;
                    top: 0;
                    z-index: 1;
                }
                &:before {
                    content: "";
                    border-top: $border-h solid transparent;
                    border-bottom: $border-h solid transparent;
                    border-left: $border-h solid #fff;
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }

            &:first-child {
                a {
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    &:before {
                        display: none;
                    }
                }
            }

            &:hover {
                a {
                    background: #7957d5;
                    color: #f1f1f1;
                    &:after {
                        border-left: $border-h solid #7957d5;
                    }
                }
            }
        }
    }
</style>
