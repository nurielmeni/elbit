var SliderPeople = (function($) {
  var max = 0;
  var current = 0;
  var slider, sliderItems, btnLeft, btnRight;

  function setActive(start, count) {
    for (var i = 0; i < sliderItems.length; i++) {
      if(i >= start && i < count + start) {
        $(sliderItems[i]).show(); 
      } else {
        $(sliderItems[i]).hide(); 
      }
    }

    current <= 0 ? btnRight.hide() : btnRight.show();
    current >= (sliderItems.length - visibleSlideNum())
      ? btnLeft.hide()
      : btnLeft.show();
  }

  function visibleSlideNum() {
    var vNum = $('.item-people:visible').length;
    return typeof vNum === 'number' ? vNum : 0;
  }

  function slideRight(num) {
    num = num || 1;
    if (current - num < 0) return;

    current -= num;
    setActive(current, max);
  }

  function slideLeft(num) {
    num = num || 1;
    if (current + max >= sliderItems.length) return;

    current += num;
    setActive(current, max);
  }

  function reportWindowSize() {
    var width = window.innerWidth;
    if (width <= 530) {
      max = 1;
    } else if (width <= 960) {
      max = 2;
    } else {
      max = 3;
    }

    setActive(current, max);
  }

  $(document).ready(function() {
    slider = $('.slider-people');
    sliderItems = $(slider).find('.item-people'); 
    
    btnRight = $('span.btn-dots.next > i');
    btnLeft = $('span.btn-dots.prev > i');

    btnRight.on('click', function() { slideRight(); });
    btnRight.on('keyup', function(e) {
      if (e.key === 'Enter') slideRight();
    });

    btnLeft.on('click', function() { slideLeft(); });
    btnLeft.on('keyup', function(e) {
      if (e.key === 'Enter') slideLeft();
    });

    // Mobile events
    MobileEvent.createListener('.slider-people', 'swiped-right', function () {
      slideRight();
    });
    MobileEvent.createListener('.slider-people', 'swiped-left', function () {
      slideLeft();
    });

    // Set the max people
    reportWindowSize();

    $(window).on('resize', reportWindowSize);
  });

  return {
    slideLeft,
    slideRight
  }
})(jQuery);