<template>
    <div class="container">
        <h3>Update Form</h3>
        <hr>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input v-model="user.first_name" type="text" class="form-control" v-bind:class="{ 'is-invalid': hasError('first_name') }" id="first_name" placeholder="First Name">
            <div class="invalid-feedback">
                {{ (hasError('first_name')) ? getError('first_name') : '' }}
            </div>
        </div>
        <div class="form-group">
            <label for="first_name">Last Name</label>
            <input v-model="user.last_name" type="text" class="form-control" v-bind:class="{ 'is-invalid': hasError('last_name') }" id="last_name" placeholder="Last Name">
            <div class="invalid-feedback">
                {{ (hasError('last_name')) ? getError('last_name') : '' }}
            </div>
        </div>
        <button @click="update" class="btn btn-primary">Update</button>
    </div>
</template>

<script>
    export default {
        name: "UpdateFamilyComponent",
        data() {
            return {
                user : {
                    first_name: '',
                    last_name: ''
                },
                validation_errors: []
            }
        },
        created() {

            this.user = JSON.parse(JSON.stringify(this.$store.getters.getUser))
            console.log('this.user', this.user)
            if (!!!this.user) {
                this.$store.dispatch("user_request")
                    .then(res => {
                        console.log(res)
                        this.user = Object.assign({}, this.$store.getters.getUser)
                    }).catch(err => {
                    console.log(err)
                })
            }

            //this.first_name = this.$store.getters.getUser.first_name
            //this.last_name = this.$store.getters.getUser.last_name
        },
        methods: {
            update() {
                const { first_name, last_name } = this.user
                this.$store.dispatch('update', {first_name, last_name})
                .then(res => {
                    console.log(res)
                    this.$router.push({name:'profile'})
                }).catch(err => {
                    console.log(err)
                })
            },
            hasError(field) {
                return !(this.validation_errors[field] === undefined)
            },
            getError(field) {
                return this.validation_errors[field][0]
            }
        }
    }
</script>

<style scoped>

</style>