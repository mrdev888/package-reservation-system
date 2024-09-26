# package-reservation-system

**STEPS I TOOK:**

1. created a laravel project by the command,
laravel new package-reservation-system

here "package-reservation-system" is our project name, and the folder name too

2. in the .env file, modified the database name to reservation, database username to root and database password to empty.

3. created the following migrations with the artisan commands:

3.1: php artisan make:model Order -a
this created for us (a) migration file, (b) model file, (c) controller file

3.2: php artisan make:model Package -m
this created for us (a) migration file and (b) model file

3.3: php artisan make:model OrderPackage -m
this created for us (a) migration file and (b) model file

4. now in the migration file for create_orders_table, I added the fields of "orders" table

5. similarly in migration file for create_packages_table, the fields of "packages" table were added

6. and in the migration file for create_order_packages_table, the fiels of "order_packages" table were added.

7. these migration files are in the /database/migrations folder of the project.

8. then seeder for the packages table was created by the command:
   php artisan make:seeder PackageSeeder

9. the PackageSeeder was created in /database/seeders folder.

10. in the PackageSeeder, some code was written to insert 30 random package table records.

11. then in the /database/seeders/DatabaseSeeder.php class, run( ) method, this statement was written to run the PackageSeeder during migration:
   $this->call([PackageSeeder::class]);

12. then the command: php artisan migrate:fresh --seed 
    this actually ran the whole migrations and created tables in the DB, and filled the Packages table with 30 random records

13. fields to the /app/Models/Order.php class were added, the SoftDeletes trait was added, and related models too.

14. similarly to the /app/Models/OrderPackage.php class, and the SoftDeletes trait was added,

15. and to the /app/Models/Package.php class, and the SoftDeletes trait was added 

16. then in the /routes/api.php two routes were created for

    (a) Getting all orders using GET method: /api/orders
    (b) Creating a new order using POST method: /api/orders

17. for this purpose /app/Http/Controllers/OrderController class was used, created two methods in it:

    (a) index( ) method for getting all the orders list
    (b) store( ) method to submit the order and thus create it.

18. in the index( ) method of OrderController, simply all the orders along with the related order_packages and package models are fetched and assigned to the $order object. the $order object is return in json format.

19. in the store( ) method of OrderController, I did the follwing:
  (a) validate the request for first_name, last_name, etc,
  (b) validate the package_id exists in the db table or not,
  (c) fetch the $package object by the given package_id key,
  (d) create the Order record
  (e) then the order_package record is created
  (f) then the order's total and total_fee is calculated, and order record is updated.
  (g) then a success message is returned.

20. to check the two APIs created, setup both of them in Postman

21. run the command in project root: php artisan serve
    this will start the laravel server on address: http://127.0.0.1:8000/
    this will be the base url for the API.

22. then in postman, create a request as the following:
    URL: http://127.0.0.1:8000/api/orders
    Method: POST
    Request Body: Form URL encoded,
    first_name,
    last_name,
    email,
    phone,
    package_id
    tickets_purchased

    Send the request to see the response
    
23. in postman create a request as the following:
    URL: http://127.0.0.1:8000/api/orders
    Method: GET
    
    this will give all the orders
    
24: the postman collection can be found in **storage/orders.postman_collection.json**



