1310MDD
=======

Full Sail Mobile Device Development Class - Rath Kaikala - Project: Procipe

SQL Dump file names include the date the dump was created.  Ensure that you are using the most current SQL dump file, as that will be the one that all of the most up-to-date code is utilizing.

The most current SQL dump as of 10/22/13 is 'procipe10-12-138-56 PM.sql'.

Testing Username: Tester
Testing Password: Password@

There are other users entered into the database to utilize for testing; however you can also create your own users by filling out the form on the app to create a new user, then use your new account to test the app.

Instructions for viewing the API Proof of Concept:

1.  Save the 1310MDD folder into your htdocs folder in MAMP.
2.  With your MAMP server on, navigate to: http://localhost:8888/1310MDD-Master/procipe/api-proof-concept.php.
3.  Ensure there is a connection to the Internet.
4.  Enter a search term to use.  Good suggestion is some sort of ingredient, such as crab, lettuce, whatever you may be in the mood to eat at the moment.
5.  Press the "Submit" button and the total number of recipes found will be displayed, as returned from the Yummly API.

Update as of 10/18/13

1.  Updated CRUD to include writing to database for new users.  Includes creation of random salting and proper hashing of password prior to storage in database.
2.  Working on checking with database for already registered usernames. Currently returns an error that states there was an error creating the user account, but does not successfully stop if username is already in database.

Update as of 10/22/13

1.  Updated search view to interact with the Yummly API.  Results are now returned and placed into a table view layout. 
2.  Updated the search view to include pagination when search populates the results.  Pagination is present but does not currently function, still working on this portion of the functionality for the search page.
3.  Working on linking the search results to show the detail view of the recipe that was clicked on.
4.  CSS framework is being utilized across the app; however still working on optimizing for mobile/smaller screen/devices.