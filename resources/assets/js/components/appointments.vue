<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Appointments <i v-if="load" class="fa fa-spinner fa-pulse fa-fw"></i></div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Date</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="appointment in appointments">
                                <td>{{ appointment.id }}</td>
                                <td>{{ appointment.name }}</td>
                                <td>{{ appointment.email }}</td>
                                <td>{{ moment(appointment.date) }}</td>
                                <td>
                                    <button class="btn btn-xs btn-default" @click.prevent="view(appointment)">View Appointment</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <view-appointment-panel :appointment_info="selected"></view-appointment-panel>
    </div>
</template>

<script>
    import ViewAppointment from './view-appointment-panel.vue';
    export default {
        data() {
            return {
                appointments: [],
                selected: {},
                load: false
            };
        },
        components: {
            'view-appointment-panel': ViewAppointment
        },
        created() {
            this.getAppointments();
            eventBus.$on('refresh_appointments', this.getAppointments)
        },
        methods: {
            getAppointments() {
                this.load = true;
                axios.get('/api/appointments/retrieve').then((response) => {
                    this.appointments = response.data.appointments;
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
            view(appointment) {
                $('#viewAppointmentModal').modal( 'show' );
                this.selected = appointment
            },
            moment(date) {
                return moment(date).format('DD/MM/YY HH:mm')
            }
        }
    }
</script>