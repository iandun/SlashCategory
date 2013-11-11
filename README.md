SlashCategory
=============

A Categorical Data Format

About
=====

SlashCategory is a simple, no frills, but powerful data format that is organized by the following:

`category/data/category/data`

Although, in reality, there is no distinction between categories and data.

For example, take the example:

`book/Lord Of The Flies/author/William Golding`

If we want to get the title of the book, we want to get the data under the `book` category, which would return the data `Lord Of The Flies`.

But if we want to get the author of the book, `Lord Of The Flies` just turns into another category, as to get the author of the book, we want to get it under the category `book/Lord Of The Flies/author`

Parsing It
==========

The format is a relatively simple one. I have built a no-frills PHP parser (because I originally started using this format with web applications). It's pretty easy to use.

Here's an example:

	<?php

	include_once 'SlashCategoryParse.php';

	$data = "book/Lord Of The Flies/author/William Golding";

	echo "Book Title: " . getData($data, "book") . " Book Author: " . getData($data, "book/Lord Of The Flies/author");

	?>

The parser is limited in the fact that it is only designed to parse data that has only unique categories (i.e. no two data entries in the same piece of data containing book/ or book/Lord Of The Flies/author, but /book/Lord Of The Flies/Summary/blah blah blah is ok). I hope to have that fixed soon!
