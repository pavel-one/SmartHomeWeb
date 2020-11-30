<template>
    <div class="column">
        <inertia-link :href="link">
            <div class="box hover-box">
                <article class="media">
                    <div class="media-left">
                        <b-icon :icon="icon" size="is-large"></b-icon>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ name }}</strong>
                                <br>
                                {{ description }}
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </inertia-link>
    </div>
</template>

<script>
export default {
    props: ['name', 'link', 'icon', 'description']
}
</script>
