/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.$ = require('jquery');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require("font-awesome-webpack");

// import Blur from './class/Blur.js';
// import Carousel from './class/Carousel.js';

window.Vue = require('vue');

window.events = new Vue()

window.flash = function(body, success = true) {

    window.events.$emit('flash', {
        body,
        success
    })
}
Vue.component('carousel', require('./components/Carousel.vue'));
Vue.component('skill', require('./components/Skill.vue'));
Vue.component('hobby', require('./components/Hobby.vue'));
Vue.component('contact', require('./components/Contact.vue'));
Vue.component('flash', require('./components/Flash.vue'));

const app = new Vue({
    el: '#app'
});


$(function() {

    let aTabs = $('.nav-link');
    let liTabs = $('.nav-item');
    let sections = $('section');
    let navbar = $('#navbar');
    let start = 0;
    let end = 5000;

    function getNavbarHeight()
    {

      let totalHeight =
        navbar.height() +
        parseInt(navbar.css('padding-top')) +
        parseInt(navbar.css('padding-bottom')) +
        parseInt(navbar.css('border-bottom-width'))
      ;

      return totalHeight;
    }

    aTabs.click(function(e) {

      e.preventDefault();

      let hash = this.hash;

      $('html').animate({
        scrollTop: ($(hash).first().offset().top - getNavbarHeight())
       },500, function() {
            $(this).clearQueue();
        });
    });

    function setCurrentSession()
    {

        let currentPos = $(this).scrollTop();

        sections.each(function(section) {

            let sectionY = $(this).offset().top;
            let offsetTop = sectionY - getNavbarHeight() - 200;

            if (currentPos >= offsetTop) {
                updateActiveClass($(this).attr('id'));
            }
        });
    }

    function updateActiveClass(attribute)
    {

        liTabs.each(function() {

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }

            if ($(this).hasClass(attribute)) {
                $(this).addClass('active');
            }
        });
    }

    let allCoord = [];
    let container = document.querySelector('.culture-items');
    let buttons = document.querySelectorAll('.culture-btn');

    function toogleActive(obj) {

        buttons.forEach(function(b) {

            if (b.classList.contains('active')) {
                b.classList.remove('active');
            }
        })

        obj.classList.add('active');
    }

    buttons.forEach(function(button) {


        button.addEventListener('click', function() {
            let buttonDataset = this.dataset.buttonType;

            toogleActive(this);
            
            document.querySelectorAll('.badget').forEach(function(badge) {

                badge.style.opacity = 1;

                if (buttonDataset === 'all') {
                    return;
                }
                
                if(badge.dataset.cultureType !== buttonDataset) {
                    badge.style.opacity = 0.4;
                }
            })
            
        })
    });

    function checkColision(newCoord, newObjWidth) {

        let bool = true; 
        let c = Math.floor((newCoord.x / 100) * container.clientWidth); 


        allCoord.forEach(function(coord) {

            let width = coord.size.width;
            let height = coord.size.height;
            let coordonates = coord.coordonate;
            let margin = 15;
            
            
            if 
            (
                ((c + width + margin) >= coordonates.x && c <= (coordonates.x + width + margin)) &&
                ((newCoord.y + height + margin) >= coordonates.y && newCoord.y <= (coordonates.y + height + margin)) ||
                (c < coordonates.x &&  ( (c + newObjWidth) >= coordonates.x) && ( (newCoord.y + height + margin) >= coordonates.y && newCoord.y <= (coordonates.y + height + margin) ) ) 
                
            ) {
                    bool = false;
                    return;
            }

        })

        return bool;
    }

    function generateRandomNumber(max) {

        return Math.floor(Math.random() * max);
    }



    function randomCoordonate(obj) {

        let coord = {
            x: generateRandomNumber(95), 
            y:generateRandomNumber(500)
        };
        
        return checkColision(coord, obj.clientWidth) === false ? randomCoordonate(obj) : coord;
    }



    let badges = document.querySelectorAll('.badget');


    badges.forEach(function(badge) {

        let coordonate = randomCoordonate(badge);

            
        badge.style.left = coordonate.x + '%';
        badge.style.top = coordonate.y + "px";



        allCoord.push(
            {
                size: {width: badge.clientWidth, height: badge.clientHeight}, 
                coordonate: {x: badge.offsetLeft, y: coordonate.y},
                obj: badge
            }
    );

    });


    /** Ajax **/

    // $('#form-contact').on('submit', function(e) {
    //
    //     e.preventDefault();
    //
    //     let timerRunning = (Date.now() >= (start + end));
    //
    //     $('.form-error').each(function() {
    //         $(this).fadeOut("fast");
    //
    //     });
    //
    //     if (timerRunning) {
    //
    //         $('.alert').fadeOut("fast");
    //
    //         $.ajax({
    //                 method: $(this).attr('method'),
    //                 url: $(this).attr('action'),
    //                 data: $(this).serialize(),
    //                 dataType: "json",
    //
    //             })
    //             .done(function(data){
    //                 $('.form-error').each(function() {
    //                     $(this).fadeOut("fast");
    //                 });
    //                 $('.alert').removeClass('alert-danger').addClass('alert-success').fadeIn('slow');
    //                 $('.alert > span').html("Message bien envoyé");
    //                 start = Date.now();
    //             })
    //             .fail(function(data){
    //
    //                 $(data.responseJSON.errors).each(function(key, el) {
    //
    //                     for(let i in el) {
    //                         let input = $('.' + i);
    //
    //                         if (input) {
    //
    //                             if (input.next().length == 0) {
    //                                 input.after('<span style="display:none" class="form-error">'+el[i][0]+'</span>');
    //                             }
    //                             input.next().fadeIn("fast", function() {
    //                                 $('.form-error').clearQueue();
    //                             });
    //                         }
    //
    //                     }
    //                 });
    //
    //             })
    //             .always(function(){
    //                 $('.alert').clearQueue();
    //             });
    //         ;
    //     }
    //     else {
    //
    //         let timeLeft = ( (end/1000) - Math.floor((Date.now() - start) / 1000) );
    //         let counter = 1;
    //
    //         $('.alert > span').html('Vous devez attendre '+ timeLeft +' avant de pouvoir relancer la requete');
    //         $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn('slow');
    //
    //         let submitTimerMessageId = setInterval(function() {
    //
    //             if (counter >= timeLeft) {
    //                 clearInterval(submitTimerMessageId);
    //                 $('.alert').fadeOut();
    //             }
    //             else {
    //                 $('.alert > span').html('Vous devez attendre '+ (timeLeft - counter) +' avant de pouvoir relancer la requete');
    //             }
    //
    //             counter++;
    //
    //         },1000);
    //     }
    //
    //
    // });

    $('.card-experiences').each(function() {

        $(this).click(function() {

            let mask = $('<div id="mask" class="mask"></div>');

            $('body').addClass('modal-active');
            $('body').append(mask);
            mask.fadeIn();
            $(this).next().fadeIn();


        });
    });

    $('.realisation-details').click(function(e) {

        e.stopPropagation();
    });

    $('#modal-box, #realisation-details-close').on('click', function(e) {

        $('body').removeClass('modal-active');
        $('.modal-box').fadeOut();
        $('#mask').fadeOut().remove();

    });

    // $('.close').click(function() {
    //
    //     $(this).parent().fadeOut();
    // });

    $('.email-footer-badge').on('click', function() {


        let $temp = $('<input id="tempo" type="text" value='+$('#test123').text()+'>');

        $(this).append($temp);
        $('#tempo').select();

        let copied = document.execCommand("Copy");

        $('#tempo').remove();

        if (copied) {
            $('#email-footer-text').addClass('active');
            setTimeout(function()
            {
                $('#email-footer-text').removeClass('active');
            }, 1500);
        }

    });

    $('.navbar-toggler').on('click', function() {

        $('#navbarNav').slideToggle();
    });

    $(window).on('load scroll', setCurrentSession);


});
