<template>
    <div class="col-6 col-sm-5 col-md-4 col-lg-3">
        <div @click="blur = !blur" class="card card-skill text-white mb-3" style="max-width: 20rem;">
            <span class="fa-icon">
                <i class="fa" :class="blur ? 'fa-times-circle' : 'fa-info-circle'" aria-hidden="true"></i>
            </span>

             <div class="bg-dark card-blur card-skill" :style="blur ? 'opacity: 0.4' : ''">
                <div class="card-header">
                    <span v-text="skill.name"></span>
                    <span v-if="skill.level.value" :class="level"></span>
                </div>
                <div class="card-body skill-img" :style="image">

                </div>
            </div>
            <div class="card-description blur" v-show="blur" :class="blur ? 'blur-active' : ''">
                <div class="blur-content">
                    <div v-if="descriptions">
                        <span v-for="description in descriptions" class="badge badge-dark ml-1"> {{ description }}</span>
                    </div>

                    <span v-else><strong>Pas de description</strong></span>
                </div>

                <a target="_blank" class="btn btn-dark card-description-link" :href="skill.url">Lien</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: { skill: {type:Object}},
        data() {
            return {

                blur:false,
                descriptions: this.skill.description
            }
        },
        mounted() {

            console.log(this.skill.level.value)
            if (this.skill.description) {

                this.descriptions = this.skill.description.split(',')
            }
        },
        computed: {

            level() {

                return `levels level-${this.skill.level.value}`
            },
            image() {

                let path = this.skill.path ? this.skill.path : 'defaults/No_image_available.png'

                return `background-image: url("/storage/${path}")`
            },

        }

    }
</script>

<style lang="css">
</style>
