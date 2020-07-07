<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Example Component</div>

                <div class="card-body">
                    I'm an example component.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tasks: {
                required: true,
                type: Array
            },
            status: {
                required: true,
                type: Array
            }
        },
        created() {
            console.log('Status: ', this.status)
            console.log('Tasks: ', this.tasks)
        }
    }
</script>
