# Shop microservice

## Backend

* Create **.env** in root directory (see [.env.example](./back/.env.example))
* Run

```bash
  composer install #to install packages

  php artisan migrate #to apply database migrations

  php artisan storage:link #to link assets directory


  #to strap application
  php artisan serve

  #also you need startup queue
  php artisan queue:work
```

* Admin panel

```bash
  yarn install
  yarn build

  #This cms doesn't support admin registration.
  #To create user you need run
  php artisan app:create-admin {name} {email} {password}
```

___

## Frontend

* Create **.env.[production|development].local** in root directory (see [.env.example](./front/.env.example))

* Run

```bash
  yarn install #to install packages

  yarn build #to build project

  #now you can serve dist directory 
  #or simplify run
  yarn preview  
```
