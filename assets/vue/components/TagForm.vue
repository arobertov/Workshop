<template>
    <form name="tag" method="post">
        <div id="tag">
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="tag_name">Name</label>
                <div class="col-sm-10"><input type="text" id="tag_name" name="tag[name]" class="form-control"></div>
            </div>
            <input type="hidden" id="tag__token" name="tag[_token]" value="9Lk4vB7Fmp-9epq8xrNiRZQhCtRRco9iGzD9i0Ce72s">
        </div>
        <button class="btn">Save</button>
    </form>
</template>

<script>
    export default {
        name: "TagForm"
    }
</script>

<style scoped>

</style>