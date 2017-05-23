<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Appointment #{{ appointment.id }}</div>

                    <div class="panel-body">
                        <h1>{{ appointment.name }}</h1>
                        <h2>{{ appointment.email }}</h2>
                        <h3>{{ moment(appointment.date) }}</h3>
                        <p v-if="!ready">Your appointment hasn't started yet, please come back at the right time</p>
                        <a v-if="ready" class="btn btn-success btn-lg" :href="'https://appear.in/' + appointment.unique_link">Head over to your Conference Call</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['appointment'],
        computed: {
            ready() {
                return moment(this.appointment.date).format('YYYY-MM-DDThh:mm') < moment().format('YYYY-MM-DDThh:mm');
            }
        },
        methods: {
            moment(date) {
                return moment(date).format('Do MMMM YYYY, h:mm a');
            }
        }
    }
</script>