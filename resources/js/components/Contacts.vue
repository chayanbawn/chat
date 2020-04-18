<template>
    <div class="contacts">
        <ul>
            <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected': index === selected}">
                <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }

        },
        data(){
            return {
                selected: -1
            }
        },
        methods: {
            selectContact(index, contact){
                this.selected = index;
                this.$emit('selected', contact);
            }
        }

    }
</script>

<style lang="scss" scoped>
    .contacts{
        flex: 2;
        max-height: 600px;
        overflow: auto;
        border-left: 1px solid darkgray;
    }
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            cursor: pointer;
            height: 80px;
            position: relative;
            border: 1px solid #ffffff;

            &.selected {
                background: #3f9ae5;
                color:white;
            }

            .avatar{
                display: flex;
                flex: 1;
                align-items: center;

                img {
                    width: 40px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }

            .contact {
                display: flex;
                flex: 3;
                flex-direction: column;
                justify-content: center;
                font-size: 16px;
                overflow: hidden;

                p {
                    margin: 0;
                    &.name { font-weight: bold}
                }
            }
        }

    }
</style>
