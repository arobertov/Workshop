<template>
    <div class="col-md-9" v-if="article.title">
        {{article.title }} i dr ...
    </div>


</template>

<script>
    export default {
        name: "Article-show",
        props:{
            article: Object
        },
        created() {
            const result =  this.$store.dispatch('articleMod/findArticle',this.$route.params.id);
        }

    }
</script>

<style scoped>

</style>