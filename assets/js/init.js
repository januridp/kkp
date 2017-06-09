(function($){
  $(function(){
    $('.slider').slider();

    $('.collapsible').collapsible();

     $('.parallax').parallax();

    $('.button-collapse').sideNav();
    
    $('.modal-trigger').leanModal();

    $('.tooltipped').tooltip({delay: 50});

    $('ul.tabs').tabs({ 'swipeable': true });

    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrainWidth: true, // Does not change width of dropdown to that of the activator
      hover: false, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'left', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    });

  }); // end of document ready
})(jQuery); // end of jQuery name space