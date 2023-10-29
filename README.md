#idn
cara install:

1. simpan projek ini di direktori yang diinginkan.
2. jika anda memiliki xampp, jalankan apache dan mysql. jika tidak punya, sesuaikan.
3. buka phpmyadmin dan buat 1 database baru.
4. kembali ke projek, buka file .env dan sesuaikan database dengan database yang telah dibuat pada point 3.
5. jalankan printah "php artisan migrate:fresh --seed" untuk melakukan migrasi database dan melakukan seeding.
6. buka folder public, hapus folder "storage".
7. jalankan perintah "php artisan storage:link"
8. jalankan perintah "php artisan serve", buka projek melalui "127.0.0.1 (default link projek laravel)", silakan login menggunakan username dan password "admin".
9. selesai.


#eng
how to install:

1. save this project to your desired directory.
2. If you have xampp, run apache and mysql. if you don't have one, adjust it.
3. Open phpmyadmin and create a new database.
4. Return to the project, open the .env file and adjust the database to the database created in point 3.
5. Run the command "php artisan migrate:fresh --seed" to migrate the database and perform seeding.
6. open the public folder, delete the "storage" folder.
7. run the command "php artisan storage:link"
8. run the command "php artisan serve", open the project via "127.0.0.1 (default laravel project link)", please log in using the username and password "admin".
9. finished.
