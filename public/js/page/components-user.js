"use strict";

$("#users-carousel").owlCarousel({
  items: 4,
  margin: 20,
  autoplay: true,
  autoplayTimeout: 5000,
  loop: true,
  responsive: {
    0: {
      items: 1
    },
    578: {
      items: 2
    },
    768: {
      items: 3
    }
  }
});
