<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="what do you wanna say?"></textarea>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                message: '',
            }
        },
        methods: {
            send(e){
                e.preventDefault();

                if(this.message === ''){
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .composer textarea {
        width: 96%;
        margin: 10px;
        padding: 6px;
        border: 1px solid lightgray;
        border-radius: 3px;
        resize: none;
    }
</style>
