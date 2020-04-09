<template>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 caption-text">Статий >> </h1>
        </div>
        <div v-if="isLoading" class="row col">
            <p>Зареждане...</p>
        </div>

        <div v-else-if="hasError" class="alert alert-danger" role="alert">
            {{ error }}
        </div>
        <div v-else-if="responseData" id="response-data-field" class="alert alert-success">
            {{responseData}}
        </div>
        <div>
            <ArticlePreview v-bind:article="article"/>
        </div>

    </div>


</template>

<script>
    import ArticlePreview from "../../components/ArticlePreview";
    export default {
        name: "Article-show",
        components:{
            ArticlePreview
        },
        computed:{
            article(){
                return this.$store.getters['articleMod/article'];
            },
            isLoading(){
                return this.$store.getters['articleMod/isLoading'];
            },
            hasError(){
                return this.$store.getters['articleMod/hasError'];
            },
            error(){
                return this.$store.getters['articleMod/error'];
            },
            responseData(){
                return this.$store.getters['articleMod/responseData'];
            }
        },
        created() {
            this.$store.dispatch('articleMod/findArticle',this.$route.params.id);
        }

    }
</script>

<style scoped>

</style>