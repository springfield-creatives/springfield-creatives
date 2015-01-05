40D Semantic SASS
=================

Installation
------------
1. You'll need to generate the configuration using your GUI tool or the command line: `compass config [path/to/config_file.rb]`
2. You can then go in and set your directories and whatnot.


Documentation
-------------
*Overview of the framework*
`http://wiki.40digits.net/40d-sass-introduction-to-the-framework`

*Category with all posts regarding the framework*
`http://wiki.40digits.net/category/learning/documentation/40d-sass-framework`


SASS/SCSS Conversion
--------------------
Please keep this repository in SCSS format before all commits. If you prefer SASS, you can convert using the following command:

*SCSS -> SASS*

`sass-convert -R --from scss --to sass scss sass && rm -rf scss`

...and then **back to SCSS before you commit:**

*SASS -> SCSS*

`sass-convert -R --from sass --to scss sass scss && rm -rf sass`
