<template>
    <div class="container desktop">
        <TweetContainer />
    </div>
</template>

<script>
import TweetContainer from '@/components/view/tweet/TweetContainer.vue';

export default {
    name: 'TweetPage',
    components: {
        TweetContainer,
    },
};
</script>

<style scoped>

</style>
