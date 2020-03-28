<template>
    <div class="main-content">
        <form name="article" method="post">
            <div id="article">
                <div class="form-group row"><label class="col-form-label col-sm-2" for="article_title">Title</label>
                    <div class="col-sm-10"><input type="text" id="article_title" name="article[title]"
                                                  class="form-control"></div>
                </div>
                <div class="form-group row"><label class="col-form-label col-sm-2"
                                                   for="article_contents">Contents</label>
                    <div class="col-sm-10"><textarea id="article_contents" name="article[contents]"
                                                     class="form-control"></textarea></div>
                </div>
                <div class="form-group row"><label class="col-form-label col-sm-2" for="article_images">Images</label>
                    <div class="col-sm-10"><select id="article_images" name="article[images][]" class="form-control"
                                                   multiple="multiple"></select></div>
                </div>
                <div class="form-group row"><label class="col-form-label col-sm-2" for="article_tags">Tags</label>
                    <div class="col-sm-10"><select id="article_tags" name="article[tags][]" class="form-control"
                                                   multiple="multiple">
                        <option value="1">Tag 1</option>
                        <option value="2">Tag 2</option>
                        <option value="3">Tag 3</option>
                        <option value="4">Tag 4</option>
                    </select></div>
                </div>
                <div class="form-group row"><label class="col-form-label col-sm-2"
                                                   for="article_category">Category</label>
                    <div class="col-sm-10"><select id="article_category" name="article[category]" class="form-control">
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                        <option value="4">Category 4</option>
                    </select></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div class="form-check"><input type="checkbox" id="article_isPublished"
                                                       name="article[isPublished]" class="form-check-input" value="1">
                            <label class="form-check-label" for="article_isPublished">Is published</label></div>
                    </div>
                </div>
                <input type="hidden" id="article__token" name="article[_token]"
                       value="Tr-4TffzjO4NzvSvTYoNc5c_3NiR6nab6eRdrFuWW00"></div>
            <button class="btn">Save</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Article-new"
    }
</script>

<style scoped>

</style>