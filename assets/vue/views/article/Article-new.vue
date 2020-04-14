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
                        <div class="col-sm-10">
                            <vue-editor :editorOptions="editorSettings" v-model="contents" class="bg-white"></vue-editor>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2" for="article_images">Images</label>
                        <div class="col-sm-10"><select id="article_images" name="article[images][]" class="form-control"
                                                       multiple="multiple"></select></div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2" for="article_tags">Tags</label>
                        <div class="col-sm-10">
                            <select v-model="tags" id="article_tags" name="article[tags][]" class="form-control" multiple>
                                <option v-for="t in tagsMod" v-bind:value="t.id">{{t.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-form-label col-sm-2"
                                                       for="article_category">Category</label>
                        <div class="col-sm-10">
                            <select v-model="category"  id="article_category" name="article[category]" class="form-control">
                                <option v-for="cat in categories" v-bind:value="cat.id" >{{cat.name}}</option>
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
                    <button class="btn btn-success" @click="createArticle($event)">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { createHelpers } from 'vuex-map-fields';
    import { VueEditor , Quill} from "vue2-editor";
    import { ImageDrop } from "quill-image-drop-module";
    import ImageResize from "quill-image-resize-module";

    Quill.register('modules/imageDrop', ImageDrop);
    Quill.register('modules/imageResize', ImageResize);

    const { mapFields } = createHelpers({
        getterType: 'articleMod/getArticleField',
        mutationType: 'articleMod/updateArticleField',
    });

    export default {
        name: "Article-new",
        components: { VueEditor },
        data() {
            return {
                content: "<h1>Initial Content</h1>",
                editorSettings: {
                    modules: {
                        imageDrop: true,
                        imageResize: {}
                    }
                }
            }
        },
        computed: {
            responseData(){
                return this.$store.getters["articleMod/getResponseData"];
            },

            error() {
                return this.$store.getters["articleMod/error"];
            },
            formErrors(){
                return this.$store.getters["articleMod/formErrors"];
            },
            categories(){
                return this.$store.getters["categoryMod/getCategories"];
            },
            tagsMod(){
                return this.$store.getters["tagMod/tags"];
            },
            ...mapFields([
                'title',
                'contents',
                'tags',
                'category',
                'isPublished'
            ]),
        },
        beforeCreate() {
            store.commit("articleMod/CREATING_ARTICLE",1);
        },
        created(){
            let store = this.$store;
            let result = store.dispatch("categoryMod/findAllCategories");
            result.then(function (e) {
               store.commit("articleMod/CREATING_ARTICLE",e[0].id);
            })
        },
        methods: {
            async createArticle(event) {
                if (event) {
                    event.preventDefault()
                }
                const result = await this.$store.dispatch("articleMod/create", this.$store.state.articleMod.article);
                if (result !== null) {
                    await this.$router.push({name:"admin_article_show",params:{"id":result.id}});
                }
            }
        }
    };
</script>

<style scoped>

</style>