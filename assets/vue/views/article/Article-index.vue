<template>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 caption-text">Всички статии</h1>
        </div>
        <div v-if="isLoading" class="alert alert-info">
            Зареждане на статий ...
        </div>

        <div v-else-if="hasError" class="alert alert-danger" role="alert">
            {{ error }}
        </div>

        <div v-else-if="!hasArticles" class="row col">
            Няма публикувана статия !
        </div>

        <div  v-else>
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
                    <paginate
                            ref="paginator"
                            name="art_index"
                            :list="articles"
                            :per="6"
                            tag="tbody"
                    >
                        <tr v-for="article in paginated('art_index')">
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
                            <td>
                                <span v-if="article.category">{{article.category.name}}</span>
                            </td>
                            <td>
                                <div v-for="tag in article.tags">
                                    {{tag.name}}
                                </div>
                            </td>
                            <td>{{article.isPublished ? 'Публикувана':'Непубикувана'}}</td>
                        </tr>
                    </paginate>
                </table>
            </div>

            <nav aria-label="Articles navigation">
                <paginate-links
                    for="art_index"
                    :limit="5"
                    :show-step-links="true"
                    :classes="{
                    'ul':'pagination',
                    'li':'page-item',
                    'li>a':'page-link'
                }"
                >
                </paginate-links>
                <span v-if="$refs.paginator">
                    Преглеждате {{$refs.paginator.pageItemsCount}} резултата
                </span>
            </nav>
        </div>


    </div>
</template>

<script>
    export default {
        name: "Article-index",
        data(){
           return {
               paginate:['art_index'],
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
         if(!this.$store.getters["articleMod/hasArticles"]){
             this.$store.dispatch("articleMod/findAll");
         }
    },
    };
</script>

<style scoped>

</style>