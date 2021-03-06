(function() {

  var container = $('#carousel-events');
  var responsiveConfig = [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ];
  var slickConfig = {
    infinite: true,
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: responsiveConfig
  };

  var main = function() {
    $.ajax({
      url: '_json/user_event.php',
      type: 'POST',
      data: {token: Cookies.get('user')},
      success: function(data, textStatus, xhr) {
        //called when successful
        $.each(JSON.parse(data), function(index, event) {
          container.append(`
            <a href="event_show.php?id=${event.id}" class="text-center">
              <div><i class="fa fa-calendar" style="font-size: 12rem"></i></div>
            </a>
          `);
        });
        container.slick(slickConfig);
      },
      error: function(xhr, textStatus, errorThrown) {
        //called when there is an error
        container.append(`
          <h3 class="text-center">There is not associated events.</h3>
        `);
      }
    });
  };

  return render(container, main);
})();
