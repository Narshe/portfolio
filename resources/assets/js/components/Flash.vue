<template lang="html">
    <div class="row">
        <div class="col-12">
            <transition name="fade">
                <div v-show="show" class="alert" :class="success ? 'alert-success' : 'alert-danger'" @click="show = false">
                    <span v-text="body"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            body: '',
            success: true,
            show: false,
        }
    },
    created() {

        window.events.$on('flash', data => this.flash(data))
    },
    methods: {

        flash(data) {

            if (data) {

                this.body = data.body
                this.success = data.success
            }

            this.show = true
        }
    }
}
</script>
