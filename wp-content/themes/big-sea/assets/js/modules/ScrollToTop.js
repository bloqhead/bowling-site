(function() {
    // ScrollToTop

  var ScrollToTop;

  ScrollToTop = class ScrollToTop {
    constructor() {
      this.scroll_check = this.scroll_check.bind(this);
      this.scroll_click = this.scroll_click.bind(this);
      this.window = jQuery(window);
      this.document = jQuery("body");
      this.btn = jQuery(".scroll-to-top");
      this.btn_hidden_class = "scroll-to-top--hidden";
      this.distance = 100;
      this.speed = 400;
      this.window.scroll(this.scroll_check);
      this.btn.on("click", this.scroll_click);
    }

    scroll_check(e) {
      if (jQuery(window).scrollTop() > this.distance) {
        this.btn.removeClass(this.btn_hidden_class);
      } else {
        this.btn.addClass(this.btn_hidden_class);
      }
    }

    scroll_click(e) {
      return this.document.animate({
        scrollTop: 0
      }, this.speed);
    }

  };

  new ScrollToTop;

}).call(this);
