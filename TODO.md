# Project Setup TODO

There is a persistent issue with installing the Composer dependencies for this project. The `vendor` directory is not being created, which prevents the application from running.

Here are the recommended steps to fix this issue:

1.  **Manually stop all running `composer` processes.** Use your system's task manager or process explorer to find and terminate all processes named `composer.exe` or similar.

2.  **Delete the `composer.lock` file.** This file may be in a corrupted state.

3.  **Clear the Composer cache.** Open a new terminal and run the following command:
    ```
    composer clear-cache
    ```

4.  **Run `composer install` again.** In the same new terminal, run the following command, which will attempt to install the dependencies from scratch:
    ```
    composer install --ignore-platform-req=ext-sodium
    ```

5.  **Verify the `vendor` directory exists.** After the command completes, check if the `vendor` directory has been created in the project root.

6.  **Try to start the application.** If the `vendor` directory exists, you can now try to start the application again:
    ```
    C:\laragon\bin\php\php-8.2.0-Win32-vs16-x64\php.exe "D:\Mon Projet\Site web Responsive\Real State\Laravel Real Estate Multilingual System\artisan" serve
