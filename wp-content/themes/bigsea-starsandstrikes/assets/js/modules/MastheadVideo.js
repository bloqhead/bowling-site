(function() {
    // Masthead video handling

  var MastheadVideo;

  MastheadVideo = class MastheadVideo {
    constructor() {
      this.VideoHandler = this.VideoHandler.bind(this);
      this.parent = jQuery(".hero--has-video");
      this.video = "<div class=\"hero-video-container\">\n  <video class=\"hero-video\" preload autoplay loop muted plays-inline>\n    <source src=\"/wp-content/themes/bigsea-starsandstrikes/assets/video/home_masthead.mp4\" type=\"video/mp4\">\n    <source src=\"/wp-content/themes/bigsea-starsandstrikes/assets/video/home_masthead.webm\" type=\"video/webm\">\n  </video>\n</div>";
      this.breakpoint = 960;
      // do nothing if there's no video present
      if (this.parent.length === 0) {
        return;
      }
      this.VideoHandler();
    }

    VideoHandler() {
      if (window.innerWidth >= this.breakpoint) {
        return this.parent.append(this.video);
      }
    }

  };

  // console.log "video inserted"
  new MastheadVideo;

}).call(this);
