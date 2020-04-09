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

        <div v-else-if="responseData" id="response-data-field" class="alert alert-success">
            {{responseData}}
        </div>

        <div v-else-if="!hasArticles" class="row col">
            Няма публикувана статия !
        </div>

        <div class="container-md bg-white">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Заглавие</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Етикети</th>
                    <th scope="col">Статус</th>
                </tr>
                </thead>
                <tr v-for="article in articles"
                    :key="article.id">
                    <td>{{article.id}}</td>
                    <td>
                        <div>{{article.title}}</div>
                        <div>|
                            <router-link :to="{name:'admin_article_show',params:{id:article.id}}" tag="a" >Прегледай</router-link>
                            |
                            <router-link :to="{name:'admin_article_edit',params:{id:article.id}}" tag="a">Редактирай</router-link>
                            |
                            <router-link :to="{name:'admin_article_delete',params:{id:article.id}}" tag="a">Изтрий</router-link>
                            |
                        </div>
                    </td>
                    <td>{{article.dateCreated | formatDate }}</td>
                    <td>{{article.author  }}</td>
                    <td>{{ article.category}}</td>
                    <td>
                        <div v-for="tag in article.tags">
                                {{tag.name}}
                        </div>
                    </td>
                    <td>{{article.isPublished ? 'Публикувана':'Непубикувана'}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Article-index",
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
            hasArticles() {
                return this.$store.getters["articleMod/hasArticles"];
            },
            articles() {
                return this.$store.getters["articleMod/articles"];
            },
        },
    created() {
         if(!this.$store.getters["articleMod/hasArticles"]){
             this.$store.dispatch("articleMod/findAll");
         }
    },
    };
</script>

<style scoped>

</style>