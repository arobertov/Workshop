<template>
    <div v-if="article.isPublished != undefined" class="container bg-white">
        <div >
            {{ article.id}}
        </div>
        <div>
            {{article.title}}
        </div>
        <div>
            <p>Съдържание :</p>
            <span v-html="article.contents"></span>
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
        <div v-if="article.category">
            <div>Категория: {{article.category.name}}</div>

        </div>
        <div v-for="tag in article.tags">
            <span>{{tag.name}}</span>
        </div>
        <div>
            <span v-if="article.isPublished">Публикувана</span>
            <span v-else>Непубикувана</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArticlePreview",
        props:{
            article: {
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>