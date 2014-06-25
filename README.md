menu
----

Here's a brief explanation:

There were a couple of details missing. 
Since this was not a real project, just a challenge, I took the liberty of filling them in on my own.
Were this to have been a real project I would have clarified first.

The details were:

1. How deep the nesting could be? I decided to keep it simple at one level deep.
2. Could an item be both a trigger to open a sub-menu as well as a link itself? I decided no.
3. Connected to #2, could top level menu items be ordinary links? I decided yes.

`index.html` contains both the HTML/CSS for the menu, as well as the form for adding/removing menu items, as well as the JavaScript.
Since there was no mention of using only vanilla JS, and I have no desire to re-invent the wheel, I used jQuery for the AJAX and DOM abstraction.
The AJAX calls assume the existence of the relevant files/controllers on the server and them returning correctly formatted data.

`query.php` contains the PHP code for pulling the menu data and creating the menu items.
It assumes the rest of the HTML exists and is injecting the items into the UL of the top level menu.
It also assumes that the DB config is stored in a separate file that defines the constants that are used, and that the file has been included.
Personally, I would not do it this way. I am used to working with an MVC structure, so I would separate pulling and sorting the data from injecting it into the HTML.

`tables.sql` contains the SQL commands for creating the tables (I assume this is what was meant by databases).
It assumes the existence of a database that is in use.
I am not sure why the need to split the menu data over 2 tables, though I don't really have any knowledge of the overall project.

I will be honest - the CSS for the menu took me a long time - upwards of 4 hours. For me it is mostly trial and error, and not my favorite thing to do.
This is the first time I've used PostgreSql, so I had to take some time to see if there were relevant differences in syntax from what I am used to (MySQL), as well as to check out the docs for the PHP PostgreSql extension.
The SQL and PHP took around 15 minutes, and the AJAX form took between 1.5 to 2 hours unti it was as I wanted it.
