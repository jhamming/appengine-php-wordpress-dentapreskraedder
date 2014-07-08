***************************************************
   Blanc WordPress theme for Welcart e-Commerce
***************************************************
[Usage Guide]
Author：Mamekko
Last updated：2014.7.1

-----contents-----
0. Preparation
1. Top page
2. Archive page
3. Single item page
4. Usage of Plugins
-----------------

This Theme is distributed under GNU GPLv3 lisence. For your usage, you are considered to have agreed GPLv3 lisence terms.
http://www.gnu.org/licenses/gpl.html


[0. Preparation]
*Categories
[Items]If you use Welcart e-Commerce plugin, please sort items under 'item' category (or its child categories) which is automatically set by welcart plugin.

[Posts] for blog shouldn't be categorized into categories for items NOTE: when Welcar e-Commerce plugins is activated, categories for items won't be shown in blog post editor.

* Default thumbnail for blog archive page
On blog archive page, this theme shows thumbnails automatically from 'post-thumbnail', otherwise one of attached images. But when any post-thumbnail or attachment is found, no-image.jpg (in /img/ folder)  is shown as the thumbnail of the post. We recommend you to replace no-image.jpg with your own.


[1. Front page]
*Custom Header Image Slides
1. Prepare images of 1600px x 400px.
2. Go [Apparance], choose Header.
3. Choose the images you want to show.
4. All uploaded images will be shown as slider.
5. You can add Title, Caption and link to image by editing it through [Media]>[Library]. Add link into 'Description'.
6. In order to remove an image from slider, go [Media]>[Library] then choose the image, and [Delite Permanently].

* Front page displays > Your latest posts
Front page shows posts only.

* Front page displays > A static page (Front page)
Page article (without title) will be shown. If you use Welcart e-Commerce plugin, it will appeare between 'What's new' and 'Recommended' Boxes. You can add bunners or images from the static page editor.

* Front page displays > A static page (Posts page)
The page becomes a front page for blog posts.

*'What's new' Box
New items released within 15 days are shown in randam order. If you want to change the period, open front-page.php then change the number of "strtotime('-15 days')" on line 55. But it would be overwrote when the theme is upgraded. It's recommended to make a child theme to change the templates.

*'Recommended' Box
Marchandises in 'itemreco' are shown in randam order.

[2. Archive page]

*Thumbnails
Priority of the thumbnails: 1. post-thumbnail, 2. one of the attached images, then 3. no-image.jpg in /img/ folder.

*Number of posts to show
- 'item' category : 12 posts
- other categories (such as blog posts) : the number you set at 'Blog pages show at most' in 'Reading Settings'.

*Tags
It is recommendable not to share same tags between 'item' posts and 'blog' posts. When a same tag is tagged for 2 of those, blog posts archive template is applied.


[3. Single item page (w/Welcart e-Commerce plugin)]
*Images of marchandises
In single page, the width of images is around 553px. Prepare the images which width is at least 553px.


[4. Usage of Plugins]
This theme has functions of 'breadcrumbs', 'related items', 'pagination' or 'Light box' etc.
Please avoid usage of those kinds of plugins because it can cause troubles.

*For Welcart e-commerce plugin users
functions.php detects front-end language for jQuery Validation Engine. In case of the languagesjQuery Validation Engine doesn't support, it will show in English.