jQuery(document).ready(function($){
	var fbshare = function (){
		u=location.href;
        t=document.title;
window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),
                'sharer',
                'toolbar=0,status=0,width=626,height=436');

            return false;

	} 

	$('.social_fb_share').click(function(){
		fbshare();
	});

	
	var gridHeight = function(){
		
		if($('.page-template-page-presse-php').length>0){
			//console.log('yep')
			$('.grid').each(function(){
				var img_height = $(this).find('img').height();
				var content_height = $(this).find('.inner_table').height();
				$(this).css({
					height:img_height+content_height
				});
			});
		}
		else{
			$('.grid').each(function(){
				var post_height = $(this).find('img').height();
				//console.log(post_height)
				if(post_height===null || post_height===undefined){
					post_height = $(this).height()
				}
				else{}

					//console.log(post_height)
				$(this).css({
					height:post_height
				});
			});
		}
	}

var $MasonryOptions = {
	// options
	columnWidth: 4,
	gutter:10,
	itemSelector: '.grid'
}  
	
var $lazyLoadOptions = {
	threshold : 500,
	effect : "fadeIn",
	load: function(){
		gridHeight();
		$('#site-content-inner.exclude').masonry($MasonryOptions).masonry('reloadItems');
	}
}
if($('.exclude').length>0){
	$('#site-content').find('img').each(function(){
		var $originSource = $(this).attr('src');
		$(this).fadeIn().lazyload($lazyLoadOptions);
	});
	imagesLoaded( document.querySelector('#site-content-inner.exclude'), function( instance ) {
        //console.log('all images are loaded');
	    //$('#site-content').fadeIn();
		gridHeight();

		//Masonry Startseite
		var container = document.querySelector('#site-content-inner.exclude');
		var msnry = new Masonry( container, $MasonryOptions);
		if($('#site-content-inner').height() === 0){
			$('#site-content-inner').css('height','initial!important')
		}
	});
}

window.onresize = function(){
	gridHeight();
	setTimeout(function(){
		if($('#site-content-inner').height() === 0){
			$('#site-content-inner').css('height','initial!important')
		}
	},200)
}

});