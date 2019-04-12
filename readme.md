
Catalog App Dev Environment Setup
-------------

Catalog App uses Laravel PHP Framework in the back-end. It's is best to use vagrant and the homestead box to create your development environment. You'll need virtual box and vagrant.

---

**Installing Prerequisites** (skip if you already have vagrant)

> **Install Virtual Box:**
  https://www.virtualbox.org/wiki/Downloads

> **Install Vagrant:**
  https://www.vagrantup.com/downloads.html

Once you have these, let's install the Homestead box
> **Install Laravel Homestead:**
https://laravel.com/docs/master/homestead#per-project-installation


---

**1. Download the catalog-app repo**

Now, clone the catalog-app repo to your desired directory:
```sh
$ git clone https://github.com/enoklabs/catalog-app.git
```

For example I have a *~/Sites/Projects/* directory where I downloaded the project, so
it would be found in <code>~/Sites/Projects/catalog-app</code>


---

**2. Run Composer**
Next, we need run <code>$ composer install</code> to update dependencies.

Once Homestead has been installed, use the **make** command to generate the **Vagrantfile** and **Homestead.yaml** file in your project root. The **make** command will automatically configure the **sites** and **folders** directives in the **Homestead.yaml** file.


*Mac / Linux:*

```
php vendor/bin/homestead make
```

*Windows:*

```
vendor\\bin\\homestead make
```


Next, run the <code>$ vagrant up</code> command in your terminal and access your project at http://homestead.test in your browser. Remember, you will still need to add an /etc/hosts file entry for *homestead.app* or the domain of your choice.

Once your Homestead environment is provisioned and running, you may want to add a custom development url. Simply map the url to your **Homestead.yaml** file:


```

folders:
    - map: ~/Sites/Projects/catalog-app
      to: /home/vagrant/code
sites:
    - map: catalog-app.dev
      to: /home/vagrant/code/public

```


---
**3. Update your host file:**

If Vagrant is not automatically managing your **hosts** file, you may need to add the new site to that file as well:
```
$ sudo vi /etc/hosts
```

add **catalog-app** to the hosts list
```
192.168.10.10  catalog-app.test
```

save it and now let's go back to the catalog-app folder:
```sh
$ cd ~/Sites/Projects/catalog-app
```

---
**4. Start the virtual machine**

Indide of **catalog-app** root directory:
```sh
$ cd ~/Sites/Projects/catalog-app
```

Run  <code> $ vagrant up </code> and the virtual machine will boot up.

Go inside virtual machine by running <code> $ vagrant ssh </code>

Once inside, we'll install all the dependencies modules
```sh
$ composer install
$ npm install

```

To compile sass and js files, run:
```sh
$ npm run dev
```

For continuous front end development with automatic browser reload, run:
```sh
$ npm run watch
```


---
**5. Environment keys:**


Make a copy of the <code>.env_example</code> file and rename it to <code>.env</code>

Check that the database settings match your homestead:

> DB_HOST=localhost

> DB_DATABASE=catalog-app

> DB_USERNAME=homestead

> DB_PASSWORD=secret


---
**6. Database**

Connect to mysql database, I use **SequelPro**
> **host:** 127.0.0.1

> **user:** homestead

> **password:** secret

> **port:** 33060

Create new database “catalog-app”:
```sh
mysql> create database catalog-app
```

After you created your database, run your migrations:

```sh
$ php artisan migrate
```

Lastly, visit the project on the browser:  http://catalog-app.test/


---

If the site has been added to your **hosts file**, run the <code> $ vagrant reload --provision</code> command from your **catalog-app** root directory:

```sh
$ cd ~/Sites/Projects/catalog-app
```

```sh
$ vagrant reload --provision
```
