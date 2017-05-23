<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Requests <i v-if="load" class="fa fa-spinner fa-pulse fa-fw"></i></div>

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
                                    <button class="btn btn-xs btn-default" @click.prevent="approve(request.id)">Approve</button>
                                    <button class="btn btn-xs btn-default" @click.prevent="reject(request.id)">Reject</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                requests: [],
                load: false
            };
        },
        created() {
            this.getRequests();
        },
        methods: {
            getRequests() {
                this.load = true;
                axios.get('/api/requests/retrieve').then((response) => {
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
            approve(id) {
                this.load = true;
                axios.post('/api/requests/approve', {
                    id: id
                }).then(() => {
                    this.getRequests();
                    eventBus.$emit('refresh_pending_list');
                }).catch((error) => {
                    this.load = false;
                    swal(
                        'Approval Error',
                        'Couldn\'t approve that request',
                        'error'
                    );
                })
            },
            reject(id) {
                this.load = true;
                axios.post('/api/requests/reject', {
                    id: id
                }).then(() => {
                    this.getRequests();
                }).catch((error) => {
                    this.load = false;
                    swal(
                        'Reject Error',
                        'Couldn\'t reject that request',
                        'error'
                    );
                })
            }
        }
    }
</script>