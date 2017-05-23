<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Request an Appointment <i v-if="load" class="fa fa-spinner fa-pulse fa-fw"></i></div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST">
                            <div class="form-group" :class="{ 'has-error': errors.has('name') }">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" v-model="name" required autofocus @keydown="errors.clear('name')">
                                </div>

                                <span class="help-block" v-if="errors.has('name')">
                                    <strong v-text="errors.get('name')"></strong>
                                </span>
                            </div>

                            <div class="form-group" :class="{ 'has-error': errors.has('email') }">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" required @keydown="errors.clear('email')">
                                </div>

                                <span class="help-block" v-if="errors.has('email')">
                                    <strong v-text="errors.get('email')"></strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" @click.prevent="sendRequest" class="btn btn-primary" :disabled="errors.any()">
                                        Send Request
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../classes/Errors';
    export default {
        data() {
            return {
                name: '',
                email: '',
                load: false,
                errors: new Errors()
            };
        },
        methods: {
            sendRequest() {
                let vm = this;
                vm.load = true;
                axios.post('/api/submit/request', {
                    name: vm.name,
                    email: vm.email
                }).then(() => {
                    vm.load = false;
                    vm.name = '';
                    vm.email = '';
                    swal(
                        'Request Sent',
                        'Your appointment request has been sent',
                        'success'
                    );
                }).catch((error) => {
                    vm.load = false;
                    vm.errors.record(error.response.data);
                })
            }
        }
    }
</script>