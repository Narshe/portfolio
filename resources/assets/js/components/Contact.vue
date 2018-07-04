<template lang="html">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <flash remaining="remaining"></flash>
            <form id="form-contact">

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input v-model="form.email" type="email" class="form-control email" name="email">
                    <transition-group name="fade">
                        <span v-if="errors.email" v-bind:key="error" v-for="error in errors.email"class="form-error">{{ error }}</span>
                    </transition-group>
                </div>
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input v-model="form.lastname" type="text" class="form-control lastname" name="lastname">
                    <transition-group name="fade">
                        <span v-if="errors.lastname" v-bind:key="error" v-for="error in errors.lastname"class="form-error">{{ error }}</span>
                    </transition-group>
                </div>

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input v-model="form.firstname" type="text" class="form-control firstname" name="firstname">
                    <transition-group name="fade">
                        <span v-if="errors.firstname" v-bind:key="error" v-for="error in errors.firstname"class="form-error">{{ error }}</span>
                    </transition-group>
                </div>

                <div class="form-group">
                    <label for="content">Message*</label>
                    <textarea v-model="form.content" class="form-control form-message content" name="content" id="content" rows="8"></textarea>
                    <transition-group name="fade">
                        <span v-if="errors.content" v-bind:key="error" v-for="error in errors.content"class="form-error">{{ error }}</span>
                    </transition-group>
                </div>
                <div class="form-group">
                    <button :disabled="sent" @click="store" type="button" class="btn btn-dark" v-text="sent ? showTimer : 'Envoyer'"></button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

    data() {

        return {

            fields: {
                firstname: '',
                email: '',
                lastname: '',
                content: ''
            },
            form: {},
            errors: {},
            sent: false,
            remaining: 30,
        }
    },
    computed: {

        showTimer() {

            return `Vous devez attendre ${this.remaining}s pour réenvoyer un message`
        }
    },
    created() {

        this.init()
    },
    methods: {

        init() {
            this.errors = {...this.fields}
            this.form = {...this.fields}
        },
        reset() {
            this.sent = false
            this.errors = {...this.fields}
        },
        lauchTimer() {

            let timerId = setInterval(() => {

                this.remaining--

                if (this.remaining < 0 ) {

                    this.sent = false
                    this.remaining = 30
                    clearInterval(timerId)
                }

            }, 1000)
        },
        handleErrors(error) {

            let message = ''
            if (error.response.data.exception === 'Exception') {

                message = error.response.data.message

            } else  {

                let errors = error.response.data.errors

                for(let field in errors) {

                    if (this.errors.hasOwnProperty(field)) {

                        this.errors[field] = errors[field]
                    }
                }

                message = "Une erreur est survenue lors de la soumission du formulaire"
            }

            flash(message, false)
        },
        store() {

            this.reset()

            axios.post(`/contact/store`, {
                'email': this.form.email,
                'firstname': this.form.firstname,
                'lastname' : this.form.lastname,
                'content': this.form.content
            }).then((response) => {

                this.sent = true

                flash(response.data.message)
                this.lauchTimer()

            }).catch((error) => {

                this.handleErrors(error)
            });

        }
    }
}
</script>


<style lang="css">
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0;
    }
</style>
