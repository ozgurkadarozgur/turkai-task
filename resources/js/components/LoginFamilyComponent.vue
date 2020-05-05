<template>
    <div class="container">
        <h3>Login Form</h3>
        <hr>
        <div class="form-group">
            <label for="email">Email</label>
            <input v-model="email" type="email" class="form-control" v-bind:class="{ 'is-invalid': hasError('email') }" id="email" placeholder="Email">
            <div class="invalid-feedback">
                {{ (hasError('email')) ? getError('email') : '' }}
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input v-model="password" type="password" class="form-control" v-bind:class="{ 'is-invalid': hasError('password') }" id="password" placeholder="Password">
            <div class="invalid-feedback">
                {{ (hasError('password')) ? getError('password') : '' }}
            </div>
        </div>
        <button @click="login" class="btn btn-primary">Login</button> or <router-link :to="{ name: 'register' }">Register</router-link>
    </div>
</template>

<script>

    export default {
        name: "LoginFamilyComponent",
        data() {
            return {
                email: '',
                password: '',
                validation_errors: []
            }
        },
        methods: {
            login() {
                const { email, password } = this
                this.$store.dispatch("login", { email, password })
                .then(res => {
                    console.log(res)
                    this.validation_errors = this.$store.getters.getValidationErrors
                    this.$router.push({ name: 'profile' })
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