# Hostel Management System

This is a small **Hostel Management System** project developed for a school assignment. It is built using **PHP**, **HTML**, **CSS**, and **JavaScript**.

> [!CAUTION]
> If you found this project helpful and want to use it yourself, you must necessarily either include the `LICENSE` file in your project root directory or link this repository in your contribution or references page.

## First Use
E-mail :\
`admin@gmail.com`

Password :\
`12345678`


## Demo
The live version of the code is running on the website
```bash
http://shano.free.nf
```

## Features

1. **Student Creation**: Allows admins to create new student profiles.
2. **Duplicate Check**: Ensures that the roll number or email of a student does not already exist in the system.
3. **Admin Record Check**: If no admin record exists, the system redirects to the **SignUp** page; otherwise, it redirects to the **Login** page.
4. **Edit Student Records**: Admins can edit student records, with restrictions on fields that cannot be changed (e.g., name, gender).
5. **Disable Edits on Certain Fields**: Prevents admins from editing unchangeable fields such as the student's name and gender.
6. **Delete Student Records**: Admins can delete student profiles from the system.
7. **Student Complaints**: Students can file complaints about food, roommates, rooms, or other issues.
8. **View Complaints**: Admin can read complaints and see which student submitted each complaint.

## Limitations

1. **Admin-Centric**: Students have very limited control over their profile (e.g., no ability to change certain fields).
2. **No Fee System**: This system does not include any fee management functionality.
3. **No Account Information Persistence**: The system does not remember account information (e.g., it doesn’t keep users logged in after a session ends).

## How to Use

1. Import the `hms.sql` file into **phpMyAdmin** to set up the database.
2. Edit the **database.php** file located in the `classes` folder to match your database details (e.g., username, password, database name).
3. Open the project in your local server and start using the system.
4. Follow the prompts for **SignUp** and **Login** to manage student records and complaints.

---

Feel free to reach out if you have any questions or need further assistance!

## Contributors ✨

- [Kishmat Bhattarai](https://github.com/Kishmat)\
- [Rijan Payangu Limbu](https://github.com/ctrlaxe)\
- [Sushan Kafle](https://github.com/Sushtha)\
- Aayush Bhetuwal


## Run Locally

Clone the project to `xampp/htdocs`

```bash
  git clone https://github.com/Kishmat/hms.git
```
Open your `Xampp Control Panel` or any similar php server and your desired browser and go to

```bash
  http://localhost/project_name/
```

