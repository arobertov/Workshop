<template>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 caption-text">Всички статии</h1>
        </div>
        <div v-if="isLoading" class="row col">
            <p>Зареждане...</p>
        </div>

        <div v-else-if="hasError" class="alert alert-danger" role="alert">
            {{ error }}
        </div>
        <div >
            {{ article.id}}
        </div>
        <div>
            {{article.title}}
        </div>
        <div>
            {{article.contents}}
        </div>
        <div>
            {{article.author}}
        </div>
        <div>
            {{article.dateCreated | formatDate}}
        </div>
        <div>
            {{article.dateEdit | formatDate}}
        </div>
        <div>
            {{article.category.name}}
        </div>
        <div v-for="tag in article.tags">
            <span>{{tag.name}}</span>
        </div>
        <div>
            {{article.isPublished ? 'Публикувана':'Непубикувана'}}
        </div>


    </div>


</template>

<script>
    export default {
        name: "Article-show",
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
            }
        },
        created() {
            this.$store.dispatch('articleMod/findArticle',this.$route.params.id);
        }

    }
</script>

<style scoped>

</style>