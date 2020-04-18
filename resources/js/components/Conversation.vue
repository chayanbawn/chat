<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select a contact'}}</h1>
        <MessageFeed :contact="contact" :messages="messages"></MessageFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>
</template>

<script>
    import MessageFeed from "./MessageFeed";
    import MessageComposer from "./MessageComposer";

    export default {
        props : {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(msg){
               if(!this.contact){
                   return;
               }
               axios.post('/conversations', {
                   to: this.contact.id,
                   message: msg,
               }).then((response) => {
                   console.log(response);
                   this.$emit('new', response.data);
               })
            }
        },
        components: { MessageFeed ,MessageComposer }
    }
</script>

<style lang="scss" scoped>
    .conversation{
        display: flex;
        flex: 5;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            margin: 0;
            padding: 10px;
            border-bottom: 1px dashed lightgray;
        }

    }
</style>
