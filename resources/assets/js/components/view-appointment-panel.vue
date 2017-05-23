<template>
    <div class="modal fade" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    <h4 class="modal-title" id="myModalLabel">View Appointment</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" v-model="appointment.name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" v-model="appointment.email">
                            </div>
                        </div>

                        <div class="form-group" :class="{ 'has-error': errors.has('info') }">
                            <label for="info" class="col-md-4 control-label">Information</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="info" v-model="appointment.info" id="info" rows="4" @keydown="errors.clear('info')"></textarea>
                            </div>

                            <span class="help-block" v-if="errors.has('info')">
                                <strong v-text="errors.get('info')"></strong>
                            </span>
                        </div>

                        <div class="form-group" :class="{ 'has-error': errors.has('date') }">
                            <label for="date" class="col-md-4 control-label">Appointment Date & Time</label>

                            <div class="col-md-6">
                                <input id="date" type="datetime-local" class="form-control" name="date" v-model="appointment.date" @keydown="errors.clear('date')">
                            </div>

                            <span class="help-block" v-if="errors.has('date')">
                                <strong v-text="errors.get('date')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" @click.prevent="update" class="btn btn-primary" :disabled="errors.any()">
                                    Update Appointment
                                </button>
                                <a :href="'/appointment/' + appointment.unique_link" class="btn btn-success">
                                    View Page
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../classes/Errors';
    export default {
        props: ['appointment_info'],
        data() {
            return {
                load: false,
                errors: new Errors()
            };
        },
        computed: {
            appointment() {
                let appointment = this.appointment_info;
                appointment.date = moment(this.appointment_info.date).format('YYYY-MM-DDThh:mm');
                return appointment
            }
        },
        methods: {
            update() {
                this.load = true;
                axios.post('/api/appointments/update', {
                    appointment: this.appointment
                }).then(() => {
                    this.load = false;
                    $('#viewAppointmentModal').modal( 'hide' );
                    eventBus.$emit('refresh_appointments');
                }).catch((error) => {
                    this.load = false;
                    this.errors.record(error.response.data);
                    swal(
                        'Approval Error',
                        'Couldn\'t approve that request',
                        'error'
                    );
                })
            }
        }
    }
</script>