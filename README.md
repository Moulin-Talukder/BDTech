# BDTech

BDTech is a comprehensive solution designed to manage inventory, accounting, and HRM for both wholesale and retail business models. This software is fully responsive and user-friendly, making it ideal for any super shop.

## Features

- Inventory Management
- POS System
- HRM and Payroll Management
- Accounting and Financial Reporting
- Multi-language Support
- Email Notifications

## Server Requirements

- **Preferred Server**: Apache/Nginx
- **PHP Version**: >= 7.1
- **Extensions**: OpenSSL, PDO, Fileinfo, Mbstring, Tokenizer, Zip Archive
- **Mod Rewrite**: Enabled

## Installation

1. **Upload Files**: Upload the `bdtech.zip` file to your server and extract it.
2. **Database Setup**: Create a database in phpMyAdmin and import `bdtech.sql` from the `dbBackup` folder.
3. **Connect Database**: Open the `.env` file and update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values.

### Installation Video

Watch the [installation video](https://youtube.com) for detailed steps.

## Common Errors

- **500 Server Error**: Update PHP to version 7.3 or later and set `APP_DEBUG` to `true` in the `.env` file to see the actual error.

## Software Update

### Update with Existing Data

1. Rename your previous database.
2. Delete the project folder and reinstall it.
3. Merge your databases using MySQL Compare or Navicat.
4. Rename the database back to the original name.

### Update without Existing Data

1. Delete your previous database.
2. Delete the project folder and reinstall it.

## POS Printer Configuration

1. Install your printer driver.
2. Set the printer as default in your system settings.
3. Configure the paper size and other settings.

## Setup Mail Server

Fill in the required information under Mail Setting in the Setting module.

## Modules and Features

### Dashboard

Provides a summary of revenue, sale returns, purchase returns, and profits. It includes various charts and recent transaction details.

### Product Management

- **Category**: Add, edit, delete, import, and export categories.
- **Product**: Add, edit, delete, import, and export products. Supports standard, digital, and combo products.

### Stock Management

Add stock through the purchase module and manage stock levels automatically.

### Sales Management

- **POS**: Create sales, manage orders, and send confirmation emails to customers.
- **Payment**: Accept various payment methods including cash, card, and PayPal.

### Expense Management

Create, edit, delete, and manage expense categories and records.

### HRM

- **Department and Employee Management**: Create, edit, delete departments and employees, manage attendance, and payroll.

### Reports

Generate various reports including profit/loss, best seller, product reports, and more.

### Settings

Manage roles, warehouses, customer groups, brands, units, taxes, and general settings. Set up SMS and email notifications.

## Support

For support, installation, and customization, please contact us at [support@BDTech.com](mailto:support@bdtech.com). We are committed to providing the best support to ensure your success.

---

With best wishes,  
LionCoders
