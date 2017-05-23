<template>
    <div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createAppointmentModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    <h4 class="modal-title" id="myModalLabel">Create Appointment</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" :value="request.name" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" :value="request.email" disabled>
                            </div>
                        </div>

                        <div class="form-group" :class="{ 'has-error': errors.has('info') }">
                            <label for="info" class="col-md-4 control-label">Information</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="info" v-model="info" id="info" rows="4" required autofocus @keydown="errors.clear('info')"></textarea>
                            </div>

                            <span class="help-block" v-if="errors.has('info')">
                                <strong v-text="errors.get('info')"></strong>
                            </span>
                        </div>

                        <div class="form-group" :class="{ 'has-error': errors.has('date') }">
                            <label for="date" class="col-md-4 control-label">Appointment Date & Time</label>

                            <div class="col-md-6">
                                <input id="date" type="datetime-local" class="form-control" name="date" v-model="date" required autofocus @keydown="errors.clear('date')">
                            </div>

                            <span class="help-block" v-if="errors.has('date')">
                                <strong v-text="errors.get('date')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" @click.prevent="convert" class="btn btn-primary" :disabled="errors.any()">
                                    Convert Request
                                </button>
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
        props: ['request'],
        data() {
            return {
                info: '',
                date: '',
                load: false,
                errors: new Errors()
            };
        },
        methods: {
            convert() {
                this.load = true;
                axios.post('/api/requests/convert', {
                    request: this.request,
                    info: this.info,
                    date: this.date
                }).then(() => {
                    this.load = false;
                    $('#createAppointmentModal').modal( 'hide' );
                    this.info = '';
                    this.date = '';
                    eventBus.$emit('refresh_pending_list');
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