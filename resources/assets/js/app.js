/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.$ = require('jquery');
require("font-awesome-webpack");

import Blur from './class/Blur.js';
import Carousel from './class/Carousel.js';


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


    /** Ajax **/

    $('#form-contact').on('submit', function(e) {

        e.preventDefault();

        let timerRunning = (Date.now() >= (start + end));

        $('.form-error').each(function() {
            $(this).fadeOut("fast");

        });

        if (timerRunning) {

            $('.alert').fadeOut("fast");

            $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",

                })
                .done(function(data){
                    $('.form-error').each(function() {
                        $(this).fadeOut("fast");
                    });
                    $('.alert').removeClass('alert-danger').addClass('alert-success').fadeIn('slow');
                    $('.alert > span').html("Message bien envoyé");
                    start = Date.now();
                })
                .fail(function(data){

                    $(data.responseJSON.errors).each(function(key, el) {

                        for(let i in el) {
                            let input = $('.' + i);

                            if (input) {

                                if (input.next().length == 0) {
                                    input.after('<span style="display:none" class="form-error">'+el[i][0]+'</span>');
                                }
                                input.next().fadeIn("fast", function() {
                                    $('.form-error').clearQueue();
                                });
                            }

                        }
                    });

                })
                .always(function(){
                    $('.alert').clearQueue();
                });
            ;
        }
        else {

            let timeLeft = ( (end/1000) - Math.floor((Date.now() - start) / 1000) );
            let counter = 1;

            $('.alert > span').html('Vous devez attendre '+ timeLeft +' avant de pouvoir relancer la requete');
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn('slow');

            let submitTimerMessageId = setInterval(function() {

                if (counter >= timeLeft) {
                    clearInterval(submitTimerMessageId);
                    $('.alert').fadeOut();
                }
                else {
                    $('.alert > span').html('Vous devez attendre '+ (timeLeft - counter) +' avant de pouvoir relancer la requete');
                }

                counter++;

            },1000);
        }


    });

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

    $('.close').click(function() {

        $(this).parent().fadeOut();
    });

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

    $(window).on('load scroll', setCurrentSession);
    Blur.bind('.card-skill');
    Blur.bind('.card-hobbies-container');
    Carousel.bind('.card-experiences');

});
