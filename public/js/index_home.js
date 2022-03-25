$(document).ready(function () {


    /**
     * Zoomin
     */
    new Zooming({
        bgColor: 'black',
        bgOpacity: 0.7,
        onBeforeOpen: function (target) {
            $(target).removeClass("aspect-ratio");
        },
        onBeforeClose: function (target) {
            $(target).addClass("aspect-ratio");
        }
    }).listen('.zoomin');


    /**
     * fonction pour le menu-tab onglet de la page portfolio item
     */
    $('#tab-content').children().hide();
    $('#tab-content div:first').show();

    $('#nav-tab li').click(function () {
        $('li a').removeClass("nav-tab-active");
        $(this).find('a').addClass("nav-tab-active");
        $('#tab-content').children().hide();

        var indexer = $(this).index(); //gets the current index of (this) which is #nav li
        $('#tab-content').children().eq(indexer).fadeIn(); //uses whatever index the link has to open the corresponding box 
    });


    /**
     * Fonction qui affiche un bouton retour en haut de la page en fonction du scroll
     */
    $(window).scroll(function () { //Fonction appelée quand on descend la page
        if ($(this).scrollTop() > 800 ) {  // Quand on est à 200pixels du haut de page,
            $('#scroll-up').fadeIn(1000).css('display', 'block');
            $('#scroll-up').fadeIn(1000);
        } else { 
            $('#scroll-up').fadeOut(1000); // Enlève les attributs CSS affectés par javascript
            
        }
    });


    /**
     * fonction qui au click slidetoggle le menu nav principal
     */
    $(".btn-title").on("click", function (event) {
        event.preventDefault();
        if ($('.header-vertical').is(':visible')) {
            $(".header-vertical").slideUp("slow");
        }
        else {
            $('.header-vertical').addClass("header-vertical-slidedown");
            $(".header-vertical").slideDown("slow");
        }
    });


/*
    function resizePage()
    {
        var largeur = $(window).width();
        if(largeur < 991) {
            $('.header-vertical').css('display', 'none');

        }
        else {
            $('.header-vertical').css('display', 'block');
            $('.header-vertical').removeClass("header-vertical-slidedown");
        }
    }

    // evenement déclenché, alias de js 
    $(window).resize(resizePage);

    // lance la fonction au moins une fois 
    resizePage()
*/

    $('.js-link').click(function () {
        var href = $(this).attr("href");
        if (href) {
            window.location = href;
        }
    });


    $('#duplicate-btn').click(function (e) {
        e.preventDefault();
        var $clone = $('#duplicate').clone().attr('id', '').removeClass('hidden');
        $('#duplicate').before($clone);
    })




    /**
     * Carroussel function
     */
    var i = 0; 
    var t;

    if(typeof imagesCaroussel == 'undefined') {
        imagesCaroussel = [];
    }

    var time = 5000;
    if (imagesCaroussel.length > 0) {
        document.slide.src = imagesCaroussel[i];
        lastIndexImg = imagesCaroussel.length - 1;
    }
      
    $('.next').click(function() {
        clearTimeout(t);
        i++;
    
        if (i <= lastIndexImg) {
            
        }
        else {
            i = 0;
           
        }
        document.slide.src = imagesCaroussel[i];
        slideImg();
    });
    
    
    $('.previous').click(function () {
        clearTimeout(t);
        i--;
        if (i >= 0) {
            
        }
        else {
            i = lastIndexImg;
            
        }
        document.slide.src = imagesCaroussel[i];
        slideImg();
    
    });
    
    function slideImg() {
        t = setTimeout(function () {
    
            if (i < lastIndexImg) {
                i++;
                
            }
            else {
                i = 0;
                
            }
            document.slide.src = imagesCaroussel[i];
            slideImg();
    
        }, time);
    }

    // On start le carroussel si il ya plus d'une image
    if (imagesCaroussel.length > 1) {
        slideImg();
    }



    /**
     * Fonction qui permet de mettre en surbrillance les elements du menu
     */
    function menuHighlight() {	
		var $chemin = $(location).attr('pathname').split( '/' );
        var $page = $chemin[1];	

        $(".header-nav a[href*='"+$page+"']").addClass('nav-a-active'); 
	};

    menuHighlight();


});