Extra Information About The SlashCategory File Format
=====================================================

This file contains extra ifnormation not included in README.md about the SlashCategory file format.

Comments
========

Comments (lines which are ignored by any good SlashCategory parser), always start with the pount symbol (#). Comments do not span multiple lines.
Example:

    /this/is/not/a/comment
    # This is a comment
    # Comments do not span multiple lines
  
Meta Information
================

Although not required, it is helpful to include the following information at the top of any piece of SlashCategory data:

* Title - the title of the information
* Description - a description of the information
* Author - the author of the information (a person or a program)
* Type - a unique string identifying the type of information (helpful to parsers)

Example:

    Page/Title/Book List
    Page/Description/A list of famous books and their authors
    Page/Author/iandun
    Page/Type/iandun.book.list.981

It is also helpful sometimes to include whether the request for data was successful or not. This should be put at the end of the document.

Example:

    # ... Page Content
    #Successful request
    Page/Request/Status/Success/Reason reqeust was successful
  
Example:

    # ... Page Content
    #Failed request
    Page/Request/Status/Failed/Reason request failed
  
  
