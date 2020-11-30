<template>
    <div class="device-item box hover-box">
        <inertia-link :href="route('dashboard.device', {device: device.id})" as="div">
            <div class="device-content">
                <div class="left">
                    <div class="icon">
                        <img :src="getIcon(device.type)" :alt="device.name">
                    </div>
                </div>
                <div class="right">
                    <div class="name">{{ device.name }}</div>
                    <div class="type">{{ device.type }}</div>
                </div>
            </div>
            <div class="bottom">
                <div class="online" :class="{is_online: device.online}">
                    <span></span> {{ device.online ? 'В сети' : 'Не в сети' }}
                </div>
                <div class="signal">
                    - {{ device.signal }} dBm
                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>
export default {
    props: ['device'],
    data() {
        return {}
    },
    methods: {
        getIcon: function (type) {
            switch (type) {
                case 'Тепловентилятор':
                    return '/storage/icons/heater.png';
                case 'Выключатель':
                    return '/storage/icons/lamp.svg';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.device-item {
    margin: 10px;

    &:hover {
        .bottom {
            .online {
                color: #FF5A5A;

                span {
                    background: #FF5A5A;
                }

                &.is_online {
                    color: #C3EF98;

                    span {
                        background: #C3EF98;
                    }
                }
            }
        }
    }

    .bottom {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        font-size: .9em;

        .online {
            color: darkred;
            display: flex;
            align-items: center;

            span {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                overflow: hidden;
                background: darkred;
                display: block;
                margin-right: 5px;
            }

            &.is_online {
                color: green;

                span {
                    background: green;
                }
            }
        }
    }

    .left {
        width: 60px;
        margin-right: 10px;
    }

    .right {
        width: 180px;
        line-height: 1.1;
    }

    .name {
        margin-bottom: 10px;
        font-weight: 500;
    }

    .type {
        color: #bfbfbf;
        font-size: 0.8em;
    }

    .icon {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        img {
            width: 100%;
        }
    }

    .device-content {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
        min-height: 70px;
    }
}
</style>
