<template>
    <div class="col-12">
        <div class="carousel">

            <transition-group :name="direction">
                <slide v-for="(slide,index) in slides" :slide='slide' :key='index' v-show="currentIndex == index">
                </slide>;
             </transition-group>

            <span @click.prevent="previous()" class="previous">
                <i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
            </span>
            <span @click.prevent="next()" class="next">
                <i class="fa fa fa-chevron-right fa-2x" aria-hidden="true"></i>
            </span>
        </div>

        <div class="col-12 bubble-box">
            <span class="carousel-bubble" v-for="(slide, index) in slides" @click="changeIndex(index)" :class="{active: currentIndex == index}"></span>
        </div>
    </div>
</template>

<script>

    import Slide from './Slide.vue'
    export default {

        components: { Slide },
        props: { data: { type:Array } },
        data() {
            return {
                currentIndex: 0,
                slides: this.data,
                direction: 'toLeft',
            }
        },
        methods: {

            next () {
                this.currentIndex = this.checkIndex(this.currentIndex+1)
                this.direction = "toLeft"
            },
            previous () {
                this.currentIndex = this.checkIndex(this.currentIndex-1)
                this.direction = "toRight"
            },
            changeIndex(index) {

                this.direction = ( this.currentIndex > index) ? 'toRight' : 'toLeft'
                this.currentIndex = this.checkIndex(index)
            },
            checkIndex(index) {

                let slidesLength = this.slides.length-1;

                if (index < 0) {
                    return slidesLength
                }
                else if (index > slidesLength) {
                    return 0
                }

                return index
            }
        }
    }
</script>

<style lang="css">


</style>
