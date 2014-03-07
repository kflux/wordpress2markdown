wordpress2markdown
==================

small php script to export all WordPress posts to Markdown textfiles (Pelican compatible - http://getpelican.com/)

**also gets the custom fields from all posts - something the official `pelican-import` script doesn't support**

1. REQUIRED: you need to place the `HTML_To_Markdown.php` script into the `wordpress2markdown` folder. make sure to get the newest one at https://github.com/nickcernis/html-to-markdown/

1. place `wordpress2markdown` folder in root folder of your WordPress installation

2. make sure the `wordpress2markdown` folder is writable for your webserver 

        sudo chown www-data:www-data wordpress2markdown
        
3. call the `wp2md.php` with your browser or use the commandline

4. the `wordpress2markdown` folder will be populated with textfiles named `your-article-slug.md` - make sure your posts have unique titles!


enjoy!
