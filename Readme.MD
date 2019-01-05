AuthSetup
==========

Laravel package to acl basic setup


1. ```sh
      $ php artisan vendor:publish --tag=migration
      $ php artisan vendor:publish --tag=config
   ```
2. In config/auth-setup.php Change the value of model key to User model
3. Use the AuthSetup/Traits/Role in User Model

WIP
=== 