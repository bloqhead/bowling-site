#
# Masthead video handling
#

class MastheadVideo

  constructor: ->
    @parent = jQuery ".hero--has-video"
    @video = """
      <div class="hero-video-container">
        <video class="hero-video" preload autoplay loop muted plays-inline>
          <source src="/wp-content/themes/bigsea-starsandstrikes/assets/video/home_masthead.mp4" type="video/mp4">
          <source src="/wp-content/themes/bigsea-starsandstrikes/assets/video/home_masthead.webm" type="video/webm">
        </video>
      </div>
    """
    @breakpoint = 960

    # do nothing if there's no video present
    return if @parent.length is 0

    @VideoHandler()

  VideoHandler : =>
    if window.innerWidth >= @breakpoint
      @parent.append @video
      # console.log "video inserted"

new MastheadVideo
