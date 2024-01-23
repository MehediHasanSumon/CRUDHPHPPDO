# CRUD Project using HTML, CSS and PHP(PDO)

This project demonstrates a simple CRUD (Create, Read, Update, Delete) application using PHP(OOP). The application allows you to manage student records in a MySQL database.

## Prerequisites

1. XAMPP: Ensure that you have XAMPP installed on your machine. You can download it here.

2. Database Setup: After installing XAMPP, start the Apache and MySQL servers. Create a new database named `pdo_project` in phpMyAdmin.

3. Table Creation: Run the following SQL query in phpMyAdmin to create the necessary `basic_data` table:

```bash
CREATE TABLE `basic_data` (
  `id` int(11) NOT NULL,
  `stu_id` int(255) NOT NULL,
  `roll` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```

4. Web Server: Clone this repository into the htdocs directory of your XAMPP installation.

```bash
git clone https://github.com/MehediHasanSumon/CRUDHPHPPDO.git
```

## Project Structure

The project has the following structure:

- `css/style.css`: The CSS file for styling the UI.
- `config.php`: Configuration file for connecting to the database.
- `index.php`: The main HTML file that contains the user interface.

## Usage

1. Open your browser and navigate to http://localhost/object_project.
2. The web application will display a form to manage student records.
3. You can add, edit, and delete student records using the provided interface.

## Technologies Used

- HTML: Markup language for creating the structure of the web pages.
- CSS: Styling language for enhancing the appearance of the application.
- PHP: Server-side scripting language for processing requests.

## Contributing

If you have any improvements or suggestions, feel free to open an issue or create a pull request.
