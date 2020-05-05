<template>
    <div class="container">
        <h3>{{ user.first_name + ' ' + user.last_name }}</h3>
        <hr>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>First Name</th>
                    <td>{{ user.first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ user.last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ user.email }}</td>
                </tr>
            </tbody>
        </table>

        <h4>Student</h4>
        <hr>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>First Name</th>
                    <td>{{ (user.student) ? user.student.first_name : ''}}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ (user.student) ? user.student.last_name : ''}}</td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td>{{ (user.student) ? user.student.code : ''}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>

    import axios from 'axios';
    import {BASE_URL} from "../constants";

    export default {
        name: "FamilyProfileComponent",
        data() {
            return {
                user: ''
            }
        },
        created() {
            this.user = this.$store.getters.getUser
            console.log(!!!this.user)
            if (!!!this.user) {
                this.$store.dispatch("user_request")
                    .then(res => {
                        console.log(res)
                        this.user = this.$store.getters.getUser
                    }).catch(err => {
                        console.log(err)
                })
            }
        },
        methods: {
            profile() {
                axios.get(BASE_URL + 'user', {
                    headers: { Authorization: 'Bearer ' + localStorage.getItem('access-token') }
                })
                .then(res => {
                    this.user = res.data.data
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>