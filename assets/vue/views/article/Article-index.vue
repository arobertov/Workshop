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
            <b-table hover
                     id="article-dashboard-index"
                     :items="articles"
                     :fields="fields"
                     :per-page="perPage"
                     :current-page="currentPage"
            >
                <template v-slot:cell(title)="data">
                    <div>{{data.item.title}}</div>
                    <b-button-group  size="sm" style="font-size: 0.5rem">
                        <b-button squared
                                :to="{name:'admin_article_show',params:{id:data.item.id}}"
                        >
                            Прегледай
                        </b-button>
                        <b-button squared
                                  :to="{name:'admin_article_edit',params:{id:data.item.id}}"
                        >
                            Редактирай
                        </b-button>
                        <b-button squared @click="deleteModal(data.item.id)">Изтрий</b-button>
                    </b-button-group>
                </template>
                <template v-slot:cell(dateEdit)="data">
                    {{data.item.dateEdit | formatDate}}
                </template>
                <template v-slot:cell(category)="data">
                    {{data.item.category.name}}
                </template>
                <template v-slot:cell(tags)="data">
                    <div v-for="tag in data.item.tags">{{tag.name}}</div>
                </template>
                <template v-slot:cell(isPublished)="data">
                    {{data.item.isPublished ? 'Публикувана':'Непубикувана'}}
                </template>
            </b-table>
            <div class="row">
                <div class="col-md-3">
                  <b-button variant="success">Намерени са <b-badge variant="light">{{rows}}</b-badge> статии</b-button>
                </div>
                <div class="col-md-9">
                  <b-pagination
                                   v-model="currentPage"
                                   :total-rows="rows"
                                   :per-page="perPage"
                                   :limit="7"
                                   aria-controls="article-dashboard-index"
                  ></b-pagination>
                </div>
            </div>

            <!---
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
                </table>
            </div>
            --->
        </div>

    </div>
</template>

<script>
    export default {
        name: "Article-index",
        data(){
           return {
               perPage:6,
               currentPage:1,
               fields:[
                    {
                        key:'id',
                        label:'ИД',
                        sortable:true
                    },
                    {
                        key: 'title',
                        label: 'Заглавие',
                        sortable: true,
                    },
                    {
                        key:'dateEdit',
                        label:'Последна редакция',
                        sortable:true
                    },
                    {
                        key:'author',
                        label:'Автор',
                        sortable:true
                    },
                    {
                        key:'category',
                        label:'Категория',
                        sortable:true
                    },
                    {
                        key:'tags',
                        label:'Етикети',
                        sortable:false
                    },
                    {
                        key:'isPublished',
                        label:'Статус : ',
                        sortable:true
                    }
                ]
           }
        },
        computed: {
            rows() {
                const rows =  this.$store.getters["articleMod/articles"];
                return rows.length;
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
            this.$store.commit("articleMod/FETCHING_ARTICLES");
            if(this.$store.getters["articleMod/articles"].length <= 1){
                 this.$store.dispatch("articleMod/findAll");
            }
    },
        methods:{
            async deleteArticle(articleId){
                const result = await this.$store.dispatch("articleMod/deleteArticle",articleId);
                if(result !== null){
                    await this.deleteSuccessModal(result);
                }
            },
            deleteSuccessModal(result){
                this.$bvModal.msgBoxOk('Статията '+result+ 'бе изтрита успешно !', {
                        id:'delete-success-modal',
                        title: 'ПОТВЪРЖДЕНИЕ !',
                        size: 'lg',
                        buttonSize: 'lg',
                        okVariant: 'success',
                        headerClass: 'p-2 border-bottom-0',
                        footerClass: 'p-2 border-top-0',
                        centered: true,
                });
                setTimeout(()=>{this.$bvModal.hide('delete-success-modal')},3000);
            },
            deleteModal(articleId){
                this.$bvModal.msgBoxConfirm('Моля потвърдете че искате да изтриете статията !', {
                    id:'delete-confirm-modal',
                    title: 'МОЛЯ ПОТВЪРДЕТЕ !',
                    size: 'lg',
                    buttonSize: 'lg',
                    okVariant: 'danger',
                    okTitle: 'ДА',
                    cancelTitle: 'НЕ',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {
                        if(value){
                            this.deleteArticle(articleId);
                        }
                    })
                    .catch(err => {
                       this.$bvModal.msgBoxConfirm(err);
                    })
            }
        }
    };
</script>

<style scoped>

</style>