<template>
    <div @click="blur = !blur" class="card-hobbies-container col-5 col-sm-5 col-md-5 col-lg-3 offset-1">
        <div class="row text-white">
            <span id="fa-icon" class="fa-icon">
                <i class="fa" :class="blur ? 'fa-times-circle' : 'fa-info-circle'" aria-hidden="true"></i>
            </span>

            <div class="col-12 col-md-12 bg-dark card-blur card-hobby" :style="blur ? 'opacity:0.4' : ''">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12">
                        <h4>{{ hobby.name }}</h4>
                    </div>
                    <div class="col-12 bg-dark text-white fa-icon-hobby">
                            <i class="fa fa-" :class="icon" aria-hidden="true"></i>
                    </div>
                </div>
            </div>

            <div v-show="blur" class="blur" :class="blur ? 'blur-active' : ''">
                <div class="blur-content" v-if="descriptions">
                    <span v-for="description in descriptions" class="badge badge-dark ml-1">{{ description }}</span>
                </div>
                <div v-else class="blur-content">
                    <strong class="text-dark">Pas de description</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: { hobby: {type:Object}},
    data() {
        return {
            blur:false,
            descriptions: this.hobby.description
        }
    },
    mounted() {

        if (this.descriptions) {

            this.descriptions = this.hobby.description.split(',')
        }
    },
    computed: {

        icon() {

            return `fa-${this.hobby.icon}`
        }
    },
}
</script>

<style lang="css">
</style>
