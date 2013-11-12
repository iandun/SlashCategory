What Is SlashCategory?
======================

SlashCategory is a simple, no frills, human readable file format that is based on data organized into categories, with each piece of data and each category separated by a foward slash (hence the same SlashCategory).

Technical Details
=================

SlashCategory is organized like the following:

`category/data/category/data`

Although, in reality, there is no distinction between categories and data.

For example, take the example:

`book/Lord Of The Flies/author/William Golding`

If we want to get the title of the book, we want to get the data under the `book` category, which would return the data `Lord Of The Flies`.

But if we want to get the author of the book, `Lord Of The Flies` just turns into another category, as to get the author of the book, we want to get it under the category `book/Lord Of The Flies/author`

Each line of data is known as a data entry. For example, there are 6 data entries in the following:

	Page/Title/Server Query Info
	OmniCraft/Api/ServerQuery/NumPlayers/1
	OmniCraft/Api/ServerQuery/MaxPlayers/20
	OmniCraft/Api/ServerQuery/Version/1.7.2
	OmniCraft/Api/ServerQuery/NumPlayers/1
	OmniCraft/Api/Request/Status/Success

Parsing It
==========

The format is a relatively simple one. I have built a no-frills PHP parser (because I originally started using this format with web applications). It's pretty easy to use. Just use the getData function:

`function getData($data, $pattern);`

Where:

`$data` is the data you want to parse.
`$pattern` is the category the data you want to retrieve is under.


Here's an example:

	<?php

	include_once 'SlashCategoryParse.php';

	$data = "book/Lord Of The Flies/author/William Golding";

	echo "Book Title: " . getData($data, "book")[0] . " Book Author: " . getData($data, "book/Lord Of The Flies/author")[0];

	?>

You'll notice that getData() returns an array. This is used if more than one data entry is found under one category, like in the example below:

	Page/Title/Book Information
	Page/Description/A list of some books and their authors
	book/title/Lord Of The Flies/author/William Golding
	book/title/Around The World In 80 Days/author/Jules Verne
	book/title/Robinson Crusoe/author/Daniel Defoe

There are three data entries under the category `book/title`. This can be useful. The example below uses this functionality to create a table displaying book names and their respective authors:

	<?php
	include_once 'data-parse.php';



	$data = "Page/Title/Book Information" . "\nPage/Description/A list of some books and their authors" . "\nbook/title/Lord Of The Flies/author/William Golding" . "\nbook/title/Around The World In 80 Days/author/Jules Verne" . "\nbook/title/Robinson Crusoe/author/Daniel Defoe";

	$bookTitleArray = getData($data, "book/title");

	echo "<h1>" . getData($data, "Page/Title")[0] . "</h1>";
	echo "<p><b>" . getData($data, "Page/Description")[0] . "</b></p>";

	echo "<table border='1'>";
	echo "\n<tr><td>Book Title</td><td>Book Author</td></tr>";
	foreach($bookTitleArray as $title)
	{
		echo "\n<tr>\n";
		echo "<td>" . $title . "</td><td>" . getData($data, "book/title/" . $title . "/author")[0] . "</td>";
		echo "\n</tr>";
	}

	echo "</table>";

	echo "<p>This page generated from the following data:</p>";
	echo "<pre>" . $data . "</pre>";

	?>

Which will produce the following HTML page:

![Resulting HTML Page](http://i.imgur.com/JQq3AMV.png?1)
	
I have also successfully used this parser using data retrieved from a cURL request, and a file.

Common Mistakes
===============

`/book/title/Around The World In 80 Days/author/Jules Verne`

No Slashes At The Beginning Of A Data Entry

`getData($data, "book/title/")`

Never put an ending slash at the end of `$pattern`.




