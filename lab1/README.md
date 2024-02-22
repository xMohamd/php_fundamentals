# Contact Form PHP

This lab contains a simple contact form implemented in PHP. The form validates user input for name, email, and message, and displays appropriate error messages if validation fails. Upon successful validation, a thank you message is displayed along with the submitted data.

## Features

- Validates name input (less than 100 characters)
- Validates email input (valid email format)
- Validates message input (less than 255 characters)
- Displays error messages for failed validation
- Displays thank you message and submitted data upon successful validation
- Retains user input for correcting validation errors
- Configuration for maximum lengths and thank you message stored in a config file

## Usage

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/xMohamd/php_fundamentals/tree/main/lab1
   ```

2. Configure the form settings in `config.php`:

   - Set the maximum length for the name (`$max_name_length`)
   - Set the maximum length for the message (`$max_message_length`)
   - Set the thank you message (`$thank_you_message`)

3. Ensure your PHP environment is set up properly. You may use a local server environment like XAMPP or WAMP.

4. Open the `index.php` file in your browser to access the contact form.
