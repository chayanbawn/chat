<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages"
                :class="`message ${ message.to === contact.id ? 'sent' : 'received' }`"
                :key="message.id"
            >
                <div class="text">{{ message.message }}</div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Object,
            },
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            scrollToBottom(){
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .feed {
        background-color: white;
        overflow: auto;
        height: 100%;
        max-height: 500px;

        ul {
            list-style-type: none;
            padding: 5px;

            li {
                &.message {
                    width: 100%;
                    margin: 10px 0;

                    .text {
                        max-width: 90%;
                        display: inline-block;
                        padding: 12px;
                        border-radius: 5px;
                    }

                    &.received {
                        text-align: right;

                        .text {
                            background: gray
                        }
                    }

                    &.sent {
                        text-align: left;

                        .text {
                            background: lightblue;
                        }
                    }
                }
            }
        }
    }
</style>
