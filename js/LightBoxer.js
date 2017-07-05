console.log('DC 001');

jQuery( document ).ready( function( $ ) {
	
	var theLinks = [];
	$('#video_container .vid').each(function(i, e){
		theLinks.push(e.getAttribute('vidSrc'));
		$(e).attr('name', i);
	});
	
	console.log(theLinks);
    function setClickHandler(id, fn) {		
      document.getElementById(id).onclick = fn;
    }


    setClickHandler('video_container', function(e) {
      var className = e.target.className;
      ~className.indexOf('htmlvid') &&
        BigPicture({
          el: e.target,
          vidSrc: e.target.getAttribute('vidSrc'),
		  links: theLinks,
		  num: e.target.getAttribute('name')
        });
      ~className.indexOf('vimeo') &&
        BigPicture({
          el: e.target,
          vimeoSrc: e.target.getAttribute('vimeoSrc')
        });
      ~className.indexOf('youtube') &&
        BigPicture({
          el: e.target,
          ytSrc: e.target.getAttribute('ytSrc')
        });
    })





});
 