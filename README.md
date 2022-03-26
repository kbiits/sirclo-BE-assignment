# Sirclo Backend Engineer Intern Technical Test

| Dependencies | Version |
|--|--|
| PHP | ^8.0.2 |
| Laravel | ^9.2 |

## Routes
```
GET 	/berat -> halaman index
GET 	/berat/{id} -> halaman detail dari berat

GET 	/berat/create -> halaman form tambah berat
POST 	/berat -> tambah data berat

GET 	/berat/{id}/edit -> halaman form edit data berat
PUT 	/berat/{id} -> edit data berat

DELETE 	/berat/{id} -> delete data berat
```

## How to Run


Jika menggunakan SSH  
```bash
git clone git@github.com:kbiits/sirclo-BE-assignment.git
```  
jika tidak menggunakan SSH  
```bash
git clone https://github.com/kbiits/sirclo-BE-assignment
```

Kemudian jalankan command berikut
```bash
cd sirclo-BE-assignment
composer install
cp .env.example .env
```
Setelah itu, harap ganti / ubah value dari DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME dan DB_PASSWORD yang ada di file .env. Sesuaikan dengan database masing-masing. Jika belum ada databasenya, harap buat terlebih dahulu dan sesuaikan nama database tersebut dengan DB_DATABASE yang ada di .env

Generate application key  
```bash
php artisan key:generate
```

Jalankan migration  
```bash
php artisan migrate
```

Untuk populate data dengan data dummy, bisa menggunakan seeder yang telah dibuat  
```bash
php artisan db:seed --class=BeratSeeder
```  
Atau bisa juga gunakan query sql yang ada di file data.sql  
 
Setelah itu jalankan command  
```bash
php artisan serve
```

Silahkan buka url `http://localhost:8000` di browser
