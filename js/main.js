// =======================================
//  Custom responsive superfish settings
//  ======================================

jQuery(document).ready(function($){
	var breakpoint = 600;
	var sf = $('ul.nav-menu');

	if ($(document).width() >= breakpoint) {
		sf.superfish({
			delay: 200,
			speed: 'fast'
		});
	}

	$(window).resize(function(){
		if ($(document).width() >= breakpoint & !sf.hasClass('.sf-js-enabled')){
			sf.superfish({
				delay: 200,
				speed: 'fast'
			});
		}else if( $(document).width() < breakpoint){
			sf.superfish('destroy');
		}

	});
});

//Toggle Search Form

jQuery(document).ready(function($){
	$('.search-toggle').click(function(){
		$('#search-container').slideToggle('fast', function(){
			$('.search-toggle').toggleClass('active');
		});
	});
});


// Masonry

jQuery(document).ready(function($){
	$('#footer-widgets').masonry({
		columnWidth: 400,
		itemSelector: '.widget',
		isFitWidth: true,
		isAnimated: true
	});
});

/**
 * Global variables
 *
 * @author Jonathan Path
 */

// Remove NavBar from iOS
if( !window.location.hash && window.addEventListener ){
    window.addEventListener( "load",function() {
        setTimeout(function(){
            window.scrollTo(0, 0);
        }, 0);
    });
    window.addEventListener( "orientationchange",function() {
        setTimeout(function(){
            window.scrollTo(0, 0);
        }, 0);
    });
}


// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}


//burger/plus : ajout de la classe .active

// function active(class1, class2, id1, id2){  //fonction qui va ajouter la classe active aux id en cliquant sur les class, et enlever la classe active si elle est présente

//     function toggle(id1,id2){   //pour éviter de dupliquer du code, on créer une fonction toggle

//         if ($('#'+id1).hasClass('active')) {

//             $('#'+id1).removeClass('active');

//         }else{

//             $('#'+id2).removeClass('active');
//             $('#'+id1).addClass('active');

//         }
//     };

//     //appels de la fonction toggle au click sur les class

//     $('.'+class1).click(function(){

//         toggle(id1, id2);

//     });

//     $('.'+class2).click(function(){

//         toggle(id2, id1);

//     });
// };

// ajout classe active burger

//active('burger','burger','site-navigation','menu-social');
// /!\ .active is not uselful anymore for main-navigation, this function has no use atm

//burger&plus : adding .active

(function() {

    "use strict";

    var toggles = document.querySelectorAll(".burger, .plus");

    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    };

    function toggleHandler(toggle) {
        toggle.addEventListener( "click", function(e) {
            e.preventDefault();
            (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
        });
    }

})();

//search-form : ajout de la classe active

$("#inpt_search").on('focus', function () {
    $(this).parent('label').addClass('active');
    $('.l-nav').addClass('open-search');

});

$("#inpt_search").on('blur', function () {
    if($(this).val().length == 0) {
        $(this).parent('label').removeClass('active');
        $('.l-nav').removeClass('open-search');
    }
});

//apparition du bouton

$(window).scroll(function() {
    if($(window).scrollTop() > 400) {
        $('a.back-to-top').fadeIn('fast');
    }else{
        $('a.back-to-top').fadeOut('fast');
    }
});

//SMOOTH SCROLL

$('a[href^="#"]').click(function(){


    //$(this).attr('href');  //this permet ici de recuprer le a sur lequel on clique. Si on mettait 'a', il recupererait tout le temps le sec1

    var href = $(this).attr('href'); //cette variable contient la string sec1, sec2 ou sec3
    var pos = $(href).offset().top; // donne le offset top et le met dans une variable
    //console.log(pos);


    /*HOMOGNISATION POUR LES VIEUX NAVIGATEURS ET CHROME*/

    var nav='html';

    if (navigator.userAgent.indexOf('WebKit')>0) {  //s'il y a un webkit => on effectue la boucle, sinon, on utilise la fonction normale
        nav='body';
    }

    $(nav).animate( {    //on veut scroller sur le doc html
        scrollTop: pos  //ben voila, on scroll jusqu'a la position du href :)
    }, {duration:500} );    //et on scroll pas trop vite

    return false;   // ! empeche d'aller sur d'autres pages, d'où le "if" qui execute a uniquement si il y a un "#"
});

//fonction de recherche

$(document).ready(function(){

    $('#inpt_search').keyup(function(){

        var recherche = $(this).val();
        var data = 'motclef=' + recherche;



        if( recherche.length > 2) {


            $.ajax({
                type: "GET",
                url: "result.php",
                data: data,
                success: function(server_response){

                    $("#result").html(server_response).show();
                }
            });
        }

    });
});



//google-analytics

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'PUT-YOUR-GA-CODE']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

//instafeed

var feed = new Instafeed({
    get: 'tagged',
    tagName: 'relache2016',
    clientId: 'e4f05466d8a5447d8548ce926dc3f31a'
});

feed.run();

//isotope

$('.por').isotope({
  // options
  itemSelector: '.evenement',
  layoutMode: 'fitRows',
  percentPosition: true,
  masonry: {
    // use element for option
    columnWidth: '.evenement'
  }
});

// init Isotope

var $grid = $('.por').isotope({
  // options
});

// init year
$(document).ready(function(){
    $grid.isotope({
        filter: $('[name=years]:checked').attr('data-filter')
    });
});
// filter items on button click
$('.filter-places-button-group').on( 'click', 'input', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});
$('.filter-years-button-group').on( 'click', 'input', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});
//selecta filtre-mois

$(document).ready(function() {

    // Filtre projets/vignettes
    //système de menu à remplacer avec la bonne div
    $('.filtre-mois li a').click(function() {
        //système de classe selecta
        $('.filtre-mois li').removeClass('selecta');
        $(this).parent().addClass('selecta');

        return true;
    });
});

// toggle expand hidden text

$('#article-relache-expand').click(function(){
    $('.article-relache-hidden').slideToggle();
});

// toggle menu
//
$('.burger').click(function(){
    if ($(window).width() < 768 ) {
        $('.main-navigation').slideToggle();
        $('.menu-social').slideToggle();
    }
});





// Get the largest of width/height of the thumbnail, then set width/height on auto/100%

(function add_class_larger_size() {

    $('.attachment-post-thumbnail').each(function(){

        if ( $(this).width() <= $(this).height() ) {
            $(this).addClass('larger-height');
        } else {
            $(this).addClass('larger-width');
        }

    });

})();


