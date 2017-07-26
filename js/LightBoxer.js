console.log('DC 001');

jQuery( document ).ready( function( $ ) {
	
	var theLinks = [];
	
	
	console.log(theLinks);
    function setClickHandler(id, fn) {		
      document.getElementById(id).onclick = fn;
    }
/*
	setClickHandler('image_container', function(e) {
      e.target.tagName === 'IMG' && BigPicture({
        el: e.target,
        imgSrc: e.target.src.replace('_thumb', '')
      });
    });
*/
    setClickHandler('local_image_container', function(e) {
		theLinks = [];
		$('#local_image_container img').each(function(i, e){
			theLinks.push(e.getAttribute('src'));
			$(e).attr('name', i);
		});
      (e.target.tagName === 'IMG' || e.target.className === 'background-image') &&
        BigPicture({
          el: e.target
        });
    });


    setClickHandler('video_container', function(e) {
		theLinks = [];
		$('#video_container .vid').each(function(i, e){
			theLinks.push(e.getAttribute('vidSrc'));
			$(e).attr('name', i);
		});
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
 