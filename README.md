# WP Starter
A starter WordPress theme to help you get started building custom sites. **[Now in version 2!](https://github.com/lopadz/wp-starter/releases)**

## New Changes & Updates
- **Re-built** and integrated with [Bootstrap 4](https://getbootstrap.com/)
- New **file structure** that _really tries_ to separate logic from presentation (read below for brief explanation)
- New **templating functions** to include/require instead of get_template_part()
- New **integrations** with [WooCommerce](https://woocommerce.com/) and [Gravity Forms](https://www.gravityforms.com/)
- New page/post **Layout Builder** powered by [ACF](https://www.advancedcustomfields.com/)

## Recommended Dev Wokflow
- Edit with [VS Code](https://code.visualstudio.com/)
- Manage dependencies with [Yarn](https://yarnpkg.com/)
- Compile with [Codekit](https://codekitapp.com/) or [Prepros](https://prepros.io/)
- Develop locally with [Laravel Valet](https://laravel.com/docs/6.x/valet) (Mac Only)

## File Structure
If you're not a fan of the [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/) in WP, give this theme a try! Using conditional logic and custom functions like **wps_get_file()** you can load any file you want plus a few more tricks (like passing data to the included file 😀).

### Terminology
If needed, you can still load templates the "normal way" to override the theme. But, if you're a rebel, here's a brief explanation of the terminology being used:

- **Components** (SCSS): Basic repeatable presentation elements (_banners, cards, etc..._)
  
- **Modules** (PHP - ACF): Repeatable sections that contain components (_columns, carousel, top banner, etc..._)

- **Partials** (PHP): Repeatable blocks of content (_header, footer, hero module, etc..._) 

- **Layouts** (PHP): Groups of partials and/or modules (_page, 404, archive, etc..._)

- **Templates** (PHP - WP): Same as WP to keep things consistent with backend. (_Homepage, Layout Builder, Sidebar Left, etc..._)

## Credits
Theme screenshot based on illustrations from [Undraw](https://undraw.co/).

## Support & Feedback
> ["Nobody's perfect."](https://youtu.be/t93u0qg5q_M) ~Hannah Montana

Ask questions, send feedback (or your fave The Office quote) to benlopez@blankdistrict.com!
