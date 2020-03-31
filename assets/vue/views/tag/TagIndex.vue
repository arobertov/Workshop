<template>
    <div>
        <div>{{ count }}</div>
        <button @click="increment">+</button>
        <button @click="decrement">-</button>
    </div>
</template>

<script>
    export default {
        name: "TagIndex",
        computed: {
            tags(){
                return this.$store.state.tagMod.tags;
            },
        },
        methods:{
            increment(){
                this.$store.commit('tagMod/increment')
            },
            decrement(){
                this.$store.commit('tagMod/decrement')
            }
        }
    }
</script>

<style scoped>

</style>