jQuery(function($) {
  
  /* Mobile Navigation */
  $('header > span').click(function() {
    if($(this).parent().hasClass('open')) {
      $(this).parent().removeClass('open');
    } else {
      $(this).parent().addClass('open');
    }
  });
  
  /* Header Swap */
  $('section.hero').prev('header').addClass('alt');
  
  $('.gallery').featherlightGallery({
		gallery: {
			fadeIn: 300,
			fadeOut: 300
		},
		openSpeed:    300,
		closeSpeed:   300
	});
  
  /* Toggle */
  $('div.collapsible').not('[data-open]').hide();
  $('a.toggle').click(function() {
    if($(this).hasClass('on')) {
      $(this).removeClass('on').find('i.fa').removeClass('fa-angle-up').addClass('fa-angle-down');
      $('div.collapsible').slideUp(150);
    } else {
      $(this).addClass('on').find('i.fa').removeClass('fa-angle-down').addClass('fa-angle-up');
      $('div.collapsible').slideDown(150);
    }
    return false;
  });

  $('.delete-entry-link').click(function(e){
    if(!confirm('Are you sure you want to delete this entry?'))
      e.preventDefault();
  });
  
});