# Messaging Project

Post simple message to paginated message forum. Project created for BCM.
 
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

I developed the project using Symfony 4, MySql 5.7 using Homestead as a VM. 

```
Symfony 4
MySql 5.7
Homestead and Virtual Box
```

### Installing Homestead

Install Homestead Virtual Machine

```
$ vagrant box add laravel/homestead 
$ (enter your providor - in my case I used "virtualbox"
```

Clone Homestead repo

```
 $ git clone https://github.com/laravel/homestead.git ~/Homestead
 $ cd Homestead
 $ git checkout v8.0.2
 $ bash init.sh
```

Upon successful clone and init you will get the output from cli:
```
$ Homestead initialized!
```

Configure your Homestead.yaml file: 
```
-- -  
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: ~/Code
      to: /home/vagrant/code

sites:
    - map: test-symfony.test
      to: /home/vagrant/code/symfony/test/public
      type: "symfony4"
      php: "7.2"

databases:
    - homestead

backup: true

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp

# blackfire:
#     - id: foo
#       token: bar
#       client-id: foo
#       client-token: bar

# zray:
#  If you've already freely registered Z-Ray, you can place the token here.
#     - email: foo@bar.com
#       token: foo
#  Don't forget to ensure that you have 'zray: "true"' for your site.
```

Get the Homestead environment up and running
```
$ vagrant up
```

Ssh into the Homestead/vagrant environment
```
$ vagrant ssh
```

Run command to create your Symfony 4 Project or setup an existing project (see below)


### Homestead Notes
If you make changes in your Homestead.yaml file after running 'vagrant up', run the following command:

```
$ vagrant reload --provision
```

#### Homestead VM DB Credentials 
If using Homestead VM, your database credentials in your Symfony 4 app (.env) will be:
 
```
DATABASE_URL=mysql://homestead:secret@127.0.0.1:3306/db_name
user: homestead
password: secret 
``` 

#### Connecting Host Machine to Database

```
host: 127.0.0.1
username: homestead
password: secret
port: 33060
```
 
## Creating your Symfony 4 Project

Run the following command in terminal (use your project name, in this case I used the name "test")
```
$ composer create-project symfony/website-skeleton test
```
 
## Setting up an existing Symfony 4 Project

Follow the instructions from Symfony docs: https://symfony.com/doc/current/setup.html

## Deployment

This project has not been deployed to a live environment

## Built With

* [Symfony 4](https://symfony.com/4) - The web framework used
* [Homestead](https://laravel.com/docs/5.7/homestead) - Virtual Machine


## Authors

* **Lindsay Murphy** - http://lswanson.com
