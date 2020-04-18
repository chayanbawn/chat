<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
        <Contacts :contacts="contacts" @selected="startConversationWith"></Contacts>
    </div>
</template>

<script>
    import Conversation from "./Conversation";
    import Contacts from "./Contacts";
    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data(){
            return {
                selectedContact: null,
                messages: [],
                contacts : []
            }
        },
        mounted() {
            Echo.private(`chat.${this.user.id}`)
            .listen('NewMessage', (e) => {
                console.log(e.message);
                this.handleIncomingMessage(e.message);
            });

           axios.get('/contacts').then((response) => { this.contacts = response.data });
        },

        methods: {
            startConversationWith(contact){
                axios.get(`/conversation/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                });
            },
            saveNewMessage(message){
                this.messages.push(message);
            },
            handleIncomingMessage(msg){
                if(this.selectedContact && (parseInt(this.selectedContact.id) === parseInt(msg.from))){
                    this.saveNewMessage(msg);
                    return;
                }
                alert(msg)
            }
        },
        components: {Conversation, Contacts}
    }
</script>

<style lang="scss" scoped>
    .chat-app{ display: flex }
</style>
