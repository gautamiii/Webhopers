# Webhopers
webhoppers test online
#steps to check the shortcode.
For developing "Custom Contact Form" with shortcode, I have created a custom plugin named "Custom Contact Form".
Here shortcode "custom_contact_form" present.

So first of all you need to install this plugin in your wordpress site then activate.
After that paste this shortcode [custom_contact_form]  on any wordpress page directly , without assigning any custom template to that page.
Then publish that page. After that view that page on frontend , you will be able to see the form with desired feature.


#Improve the performance of a WordPress site by deferring the loading of JavaScript files, except for jquery.js
We have created the the custom contact form with required filed with validation.

if you want to defer all script except jquery.js , you can modify how wordpress loads javascript.

we will add script in functions.php file. OR by creating a custom plugin.

Once this script is added then we can check through wordpress site.

First need to go to site , then open the developer console then go to network tab , then reload the page. We can see there if javascript files are loading with defer.

