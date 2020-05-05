<template>
    <div class="container">
        <h3>Registration Form</h3>
        <hr>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input v-model="first_name" type="text" class="form-control" v-bind:class="{ 'is-invalid': hasError('first_name') }" id="first_name" placeholder="First Name">
            <div class="invalid-feedback">
                {{ (hasError('first_name')) ? getError('first_name') : '' }}
            </div>
        </div>
        <div class="form-group">
            <label for="first_name">Last Name</label>
            <input v-model="last_name" type="text" class="form-control" v-bind:class="{ 'is-invalid': hasError('last_name') }" id="last_name" placeholder="Last Name">
            <div class="invalid-feedback">
                {{ (hasError('last_name')) ? getError('last_name') : '' }}
            </div>
        </div>
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
        <div class="form-group">
            <label for="code">Student Code</label>
            <input v-model="code" type="text" class="form-control" v-bind:class="{ 'is-invalid': hasError('code') }" id="code" placeholder="Student Code">
            <div class="invalid-feedback">
                {{ (hasError('code')) ? getError('code') : '' }}
            </div>
        </div>
        <button @click="register" class="btn btn-primary">Register</button> or <router-link :to="{ name: 'login' }">Login</router-link>
    </div>
</template>

<script>

    export default {
        name: "RegisterFamilyComponent",
        data() {
            return {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                code: '',
                validation_errors: []
            }
        },
        methods: {
            register() {
                const { first_name, last_name, email, password, code } = this
                this.$store.dispatch('register', {first_name, last_name, email, password, code})
                    .then(res => {
                        console.log(res)
                        if (res.status === 'err') {
                            console.log(res.data)
                            this.validation_errors = res.data
                        } else this.$router.push({ name: 'login' })
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