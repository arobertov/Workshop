<template>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 caption-text">Създай статия</h1>
        </div>
        <div v-if="error"  class="alert alert-danger">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="container-sm ">
            <form name="article" method="post">
                <div id="article">
                    <div class="badge badge-danger" v-if="formErrors.title"> {{formErrors.title}}</div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="article_title">Title</label>
                        <div class="col-sm-10"><input v-model="title" type="text" id="article_title" name="article[title]" class="form-control"></div>
                    </div>
                    <div class="badge badge-danger" v-if="formErrors.contents"> {{formErrors.contents}}</div>
                    <div class="form-group row"><label class="col-form-label col-sm-2"
                                                       for="article_contents">Contents</label>
                        <div class="col-sm-10"><textarea v-model="contents" id="article_contents" name="article[contents]"
                                                         class="form-control"></textarea></div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2" for="article_images">Images</label>
                        <div class="col-sm-10"><select id="article_images" name="article[images][]" class="form-control"
                                                       multiple="multiple"></select></div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2" for="article_tags">Tags</label>
                        <div class="col-sm-10"><select v-model="tags" id="article_tags" name="article[tags][]" class="form-control"
                                                       multiple="multiple">
                            <option value="1">Tag 1</option>
                            <option value="2">Tag 2</option>
                            <option value="3">Tag 3</option>
                            <option value="4">Tag 4</option>
                        </select></div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2"
                                                       for="article_category">Category</label>
                        <div class="col-sm-10">
                            <select v-model="category"  id="article_category" name="article[category]" class="form-control">
                                <option v-for="category in categories" v-bind:value="category.id" >{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div class="form-check"><input v-model="isPublished" type="checkbox" id="article_isPublished"
                                                           name="article[isPublished]" class="form-check-input" value="1">
                                <label class="form-check-label" for="article_isPublished">Is published</label></div>
                        </div>
                    </div>
                    <input type="hidden" id="article__token" name="article[_token]"
                           value="Tr-4TffzjO4NzvSvTYoNc5c_3NiR6nab6eRdrFuWW00">
                    <button class="btn btn-success" @click="createArticle($event)">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { createHelpers } from 'vuex-map-fields';
    const { mapFields } = createHelpers({
        getterType: 'articleMod/getArticleField',
        mutationType: 'articleMod/updateArticleField',
    });
    export default {
        name: "Article-new",
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
            store.commit("articleMod/CREATING_ARTICLE");
            let result = this.$store.dispatch("categoryMod/findAllCategories");
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