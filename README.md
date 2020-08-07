# demo application
Small project created with the goal of showing knowledge of some web technologies as well as good coding practices.

This project has been created with the help of XAMPP, Symfony 5, MySQL, Javascript and the latest version of php.
* XAMPP: Easy to use Apache distribution containing different tools like PHP and MariaDB. Useful package to create and test locally new web applications. Other versions like WAMP or LAMP are also disponible if you desire to work with other tools in particular.
* Symfony 5:PHP framework used to create web applications.
* MySQL: Relational database.
* Javascript: Scripting language.
= PHP: Scripting language.

Steps used to run the project with the tools specified(the project can also technically be run with any other tools supporting the necessary functions):
1. install XAMPP.
2. Clone the repository inside the htdocs folder of your XAMPP installation.
3. Launch XAMPP.
4. Launch both the Apache and MySQL modules.(the others are currently optional and are not affecting the functionnality of the application)
5. Start your command prompt and enter the project hierachy.
6. Launch the symfony server with the command. 
> symfony server:start
6. run the commands to create the database locally:
>php bin/console doctrine:migrations:diff
>php bin/console doctrine:migrations:migrate
7. Go to your localhost + /demo_application/home/
8. that's it! you are now on the first page of the application and can navigate it how you desire.

The current architecture of the web application is :

 * Home
   * Home
   * About us
   * Sign in
   * Log in
   
After signing in and creating a user, you will have access to the following new architecture:

 * Home
   * Home
   * View all my current submissions
   * Create a new submission
   * About us
   * Sign in
   * Log out
   
Option to delete your current submissions or edit them can be done from the "View all my submissions" page.
