<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<ol>
  <li>Clone the GitHub repository in your htdocs folder with the command <code>git clone https://github.com/thenasterbd/Laravel_bladimir.git</code></li>
  <li>Then go to the <code>cd Laravel_bladimir</code> folder</li>
  <li>Run the following commands from the terminal inside the project: <code>composer install</code> and <code>npm install</code>.</li>
  <li>Turn on the local apache and Mysql server.</li>
  <li>Then you have to run the migrations, but first make sure to include the <code>.env</code> file and the images folder in the <code>Storage/app</code> path, then use the command <code>php artisan migrate</code> and it will ask you if you want to create the database and say yes. You will see several green messages, the default database is called <strong>pixel_pionner</strong>.</li>
  <li>You have to load the test data, it will be done in steps:
    <ul>
      <li>First <code>php artisan db:seed --class=UsersSeeder</code></li>
      <li>Second <code>php artisan db:seed --class=ImagesSeeder</code></li>
      <li>Third <code>php artisan db:seed --class=CommentsSeeder</code></li>
      <li>And the remaining ones... <code>php artisan db:seed</code></li>
    </ul>
  </li>
  <li>Now open another terminal, in the first one you put the command <code>php artisan serve</code> and in the second terminal <code>npm run dev</code>.</li>
  <li>Ready and you can enter. The default user is <code>admin@example.com</code> with the password <code>admin123</code>.</li>
</ol>
<p><strong>Notice:</strong> If you want to test the password recovery function, you must use a real email and have an internet connection.</p>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
