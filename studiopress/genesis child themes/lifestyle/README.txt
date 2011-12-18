<strong>LIFESTYLE CHILD THEME</strong>
<a href="http://www.studiopress.com/themes/lifestyle">http://www.studiopress.com/themes/lifestyle</a>

<strong>INSTALL</strong>
1. Upload the Lifestyle child theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Lifestyle theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

<strong>WIDGET AREAS</strong>
Primary Sidebar - This is the primary sidebar if you are using the Content/Sidebar, Sidebar/Content, Content/Sidebar/Sidebar, Sidebar/Sidebar/Content or Sidebar/Content/Sidebar Site Layout option.
Secondary Sidebar - This is the secondary sidebar if you are using the Content/Sidebar/Sidebar, Sidebar/Sidebar/Content or Sidebar/Content/Sidebar Site Layout option.
Sidebar Bottom Left - This is the bottom left sidebar which is placed under the primary sidebar.
Sidebar Bottom Right - This is the bottom right sidebar which is placed under the primary sidebar.
Home - This is the main section of the homepage.
Home Left - This is the left section of the homepage.
Home Right - This is the right section of the homepage.
Footer #1 - This is the first column of the footer section.
Footer #2 - This is the second column of the footer section.
Footer #3 - This is the third column of the footer section.

<strong>POST FORMATS</strong>
To utilize the post format functionality of WordPress and the Lifestyle theme, you will need to go into the Lifestyle child theme functions.php file and change this code:

/** Add support for post formats */
// add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
// add_theme_support( 'genesis-post-format-images' );

To this:

/** Add support for post formats */
add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
add_theme_support( 'genesis-post-format-images' );

<strong>FEATURED IMAGES</strong>
By default WordPress will create a default thumbnail image for each image you upload and the size can be specified in your dashboard under Settings > Media. In addition, the Lifestyle child theme creates the following thumbnail images you'll see below, which are defined (and can be modified) in the functions.php file. These are the recommended thumbnail sizes that are used on the Lifestyle child theme demo site.

featured - 590px by 250px
homepage - 120px by 120px
mini - 80px by 80px
portfolio - 202px by 140px

<strong>SUPPORT</strong>
Please visit <a href="http://www.studiopress.com/support">http://www.studiopress.com/support</a> for theme support.