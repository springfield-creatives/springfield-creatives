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
  
  /* Toggle */
  $('div.collapsible').hide();
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
  
});