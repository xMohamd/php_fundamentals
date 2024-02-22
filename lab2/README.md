# Contact Form with File Logging - README

This lab is a PHP-based contact form with additional features for file logging of visit data. Here's a brief overview of the functionalities and how to use them:

## Features:

1. **Contact Form**: A simple contact form where users can submit their name, email, and message.
2. **Validation**: Validates user input for name, email, and message length/format.
3. **File Logging**: Logs visit data including visit date, time, user IP address, email, and name to a text file.
4. **Interface**: An interface `log_viewer` to view the data stored in the log file.

## Files and Structure:

- **index.php**: Contains the contact form and handles form submissions.
- **config.php**: Configuration file containing constants such as max length, log file paths, etc.
- **functions.php**: Defines the function to log visit data to a text file.
- **logs.txt**: The text file where visit data is logged.

## Usage:

1. Clone the repository to your local environment.
2. Ensure you have PHP and a web server (e.g., Apache, Nginx) set up.
3. Install Composer if not already installed.
4. Run `composer update` and `composer dump-autoload` to install dependencies.
5. Configure `config.php` according to your requirements.
6. Access `index.php` in your web browser to use the contact form.
7. Upon successful submission, visit data will be logged to `logs.txt`.
8. To view data, visit `log_viewer.php`.
