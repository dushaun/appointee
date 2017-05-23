<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pending <i v-if="load" class="fa fa-spinner fa-pulse fa-fw"></i></div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="request in requests">
                                <td>{{ request.id }}</td>
                                <td>{{ request.name }}</td>
                                <td>{{ request.email }}</td>
                                <td>
                                    <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#createAppointmentModel" @click.prevent="select(request)">Create Appointment</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <create-appointment-panel :request="selected"></create-appointment-panel>
    </div>
</template>

<script>
    import CreateAppointment from './create-appointment-panel.vue';
    export default {
        data() {
            return {
                requests: [],
                selected: {},
                load: false
            };
        },
        components: {
            'create-appointment-panel': CreateAppointment
        },
        created() {
            this.getRequests();
            eventBus.$on('refresh_pending_list', this.getRequests);
        },
        methods: {
            getRequests() {
                this.load = true;
                axios.get('/api/requests/retrieve/approved').then((response) => {
                    this.requests = response.data.requests;
                    this.load = false;
                }).catch((error) => {
                    this.load = false;
                    swal(
                        'Loading Error',
                        'There was an error loading your requests',
                        'error'
                    );
                })
            },
            select(request) {
                $('#createAppointmentModal').modal( 'show' );
                this.selected = request
            }
        }
    }
</script>