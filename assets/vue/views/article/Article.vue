<template>
    <div>
        <h1>Skeleton</h1>
        <article-show v-bind="article" ></article-show>
    </div>
</template>

<script>

    import { createHelpers } from 'vuex-map-fields';
    import ArticleShow from "./Article-show";
    const { mapFields } = createHelpers({
        getterType: 'articleMod/getArticleField',
        mutationType: 'articleMod/updateArticleField',
    });
    export default {
        name: "Article",
        components:{
           'article-show' : ArticleShow
        },
        computed: {
            responseData(){
                return this.$store.getters["articleMod/getResponseData"];
            },
            isLoading() {
                return this.$store.getters["articleMod/isLoading"];
            },
            hasError() {
                return this.$store.getters["articleMod/hasError"];
            },
            error() {
                return this.$store.getters["articleMod/error"];
            },
            formErrors(){
                return this.$store.getters["articleMod/formErrors"];
            },
            hasArticles() {
                return this.$store.getters["articleMod/hasArticles"];
            },
            articles() {
                return this.$store.getters["articleMod/articles"];
            },
            categories(){
                return this.$store.getters["categoryMod/getCategories"];
            },
            article(){
                return this.$store.getters["articleMod/article"];
            },
            ...mapFields([
                'title',
                'contents',
                'tags',
                'category',
                'isPublished'
            ]),
        },
        created(){
            let store = this.$store
            let result = store.dispatch("categoryMod/findAllCategories");
            result.then(function (e) {
                store.commit("articleMod/updateCategoryField",e[0].id);
            })
        },
        methods: {
            async createArticle(event) {
                if (event) {
                    event.preventDefault()
                }
                //console.log(this.$store.state.articleMod.article);
                const result = await this.$store.dispatch("articleMod/create", this.$store.state.articleMod.article);
                if (result !== null) {
                    await this.$router.push({name:"admin_article_index"});
                }
            }
        }
    };
</script>

<style scoped>

</style>