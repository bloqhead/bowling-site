# Big Sea Timber Base Theme

## What is Timber?
[Timber](https://github.com/timber/timber) is a WordPress plugin that lets you write themes with object-oriented
markup, and the [Twig template engine](http://twig.sensiolabs.org/).

## Some Features
* Heavy clean up of the WordPress head (credit to [Bones](https://github.com/eddiemachado/bones))
* Standard WordPress theme templates are abstracted out into Twig files for easy development
* A template structure based on [Underscores](https://github.com/automattic/_s)
* Small JavaScript features added for things we repeatedly found ourselves doing
* Instead of having everything dumped into `functions.php`, we've abstracted everything out into the `library` directory
* Baked-in custom post types and custom taxonomies that you can easily modify
* A robust, extremely fast and versatile Gruntfile that features image and SVG optimization (via [SVGO](https://github.com/svg/svgo)), as well as Coffeescripts compilation and even [BrowserSync](https://browsersync.io/)!
* The [Bourbon](http://bourbon.io/) and [Neat](http://neat.bourbon.io/) libraries are baked into the `package.json` file so that you have a huge set of mixins and tools immediately at your disposal
  - While we don't use Neat's grid system, we use some of its mixins, such as `media` and `new-breakpoint`
* Instead of using Neat's grids, we are using instead using [Flexbox Grid Mixins](http://thingsym.github.io/flexbox-grid-mixins/). We believe it's time to get on board the flexbox grids train

## Get Started
1. Clone the theme to your `/wp-content/themes` directory and rename it as you see fit. **NOTE:** This is made to be used as a standalone theme instead of as a child theme
2. Assuming you have [NPM](https://www.npmjs.com/) installed, navigate to your theme's folder in your favorite command line tool and run `npm install` to install all of the require Node modules (you may have to use `sudo`)

### Using GruntJS
* **I want to start writing sass:** `/assets/scss`, simply run `grunt watch`
* **I want BrowserSync:** run `grunt dev` (this also runs `watch`)
* **I want to optimize my assets:** run `grunt assets`
* **I want to build for production:** run `grunt build` (remember to switch over to your minified assets! You can do so in `/library/bigsea.php`.)

### Assets
All of your theme's bitmap images go into `/assets/images/src` and SVGs go into `/assets/images/src/svg`. Once you've done this, make sure to run `grunt assets` to compress and optimize them. They will then be available in `/assets/images`.
