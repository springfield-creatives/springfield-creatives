$(document).ready(function() {
  
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
  
});