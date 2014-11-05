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
		/*
		
		*/
	}

var $MasonryOptions = {
	// options
	columnWidth: '.grid.half',
	gutter:23
}  
	
var $lazyLoadOptions = {
	gutter:23,
	effect : "fadeIn",
	load: function(){
		gridHeight();
		$('#site-content-inner.exclude').masonry($MasonryOptions).masonry('reloadItems');
		measureSidebar();
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
	});
}

window.onresize = function(){
	gridHeight();		
	
}

function measureSidebar(){
	var contentHeight = $('#site-content').height();
	var sidebarHeight = $('#site-sidebar-right').height();
	var $offset = 50;
	//console.log(contentHeight,sidebarHeight);

	if(window.innerWidth > 800){

		if(sidebarHeight != null || sidebarHeight === undefined ){

			if(contentHeight<sidebarHeight){

				$('#site-main').height(sidebarHeight + $offset);
			}
			else{
				//console.log(contentHeight)
				$('#site-main').height(contentHeight + $offset + 20);
			}
		}
	}
	else{
		
		$('#site-main').css('height','initial');
		$('#site-content-inner > article.page').css('position','relative!important');
	}
}

measureSidebar();
});