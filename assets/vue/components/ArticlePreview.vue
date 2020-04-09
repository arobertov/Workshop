<template>
    <div v-else class="container bg-white">
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