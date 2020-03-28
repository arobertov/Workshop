<template>
    <div class="main-content">
        <h2></h2>
        <div v-for="article in articles"
                :key="article.id">
            <p>{{article.title}}</p>
        </div>
    </div>
</template>

<script>
    import Post from "../../components/Post";
    export default {
        name: "Article-index",
        components: { Post },
        data(){
            return{
                message: ''
            }
        },
        computed: {
            isLoading() {
                return this.$store.getters["articleMod/isLoading"];
            },

            hasError() {
                return this.$store.getters["articleMod/hasError"];
            },
            error() {
                return this.$store.getters["articleMod/error"];
            },
            hasArticles() {
                return this.$store.getters["articleMod/hasArticles"];
            },
            articles() {
                return this.$store.getters["articleMod/articles"];
            },
        },
    created() {
        this.$store.dispatch("articleMod/findAll");
    },
    methods: {
        async createArticle() {
            const result = await this.$store.dispatch("articleMod/create", this.$data.message);
            if (result !== null) {
                this.$data.message = "";
            }
        }
    }
    };
</script>

<style scoped>

</style>