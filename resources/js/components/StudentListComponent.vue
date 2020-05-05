<template>
    <div class="container">
        <h3>Students</h3>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Family</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in students" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.first_name + ' ' + item.last_name }}</td>
                    <td>{{ item.family }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "StudentListComponent",
        data() {
            return {
                students: []
            }
        },
        mounted() {
            this.$store.dispatch('students')
                .then(res => {
                    //console.log(res)
                    this.students = this.$store.getters.getStudents
                }).catch(err => {
                    console.log(err)
                })
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
    }
</script>

<style scoped>

</style>