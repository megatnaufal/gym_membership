# Anytime Fitness - Gym Membership Management System

> [!IMPORTANT]
> **Note: This project is created as an academic assignment and is for educational purposes only.**

## Assignment Details

**Course:** SYSTEMS ANALYSIS AND DESIGN IN INFORMATION MANAGEMENT (IMS613)  
**Group Assignment:** GYM MEMBERSHIP  
**Prepared For:** SIR AHMAD NAZRI BIN MANSOR  
**Group:** CDIM2625A  

**Prepared By:**

| Name | Student ID |
| :--- | :--- |
| FARIS AFIZUAN BIN ABD KAHARMUZAKIR | 2025136615 |
| MEGAT NAUFAL SYABIL BIN ZAMRI | 2025121211 |
| NURLIYANA NAJWA BINTI ROSLAN | 2025381073 |
| NURUL AIN SYAFINAZ BINTI MD THANI | 2025165683 |

---

This repository contains the source code for the Anytime Fitness Gym Membership Management System, built using the [CakePHP](https://cakephp.org) framework.

## Test Accounts
For testing and grading purposes, you can use the following pre-configured accounts:

**Member Account**
- **Username:** `megat@gmail.com`
- **Password:** `password123`

**Trainer Account**
- **Username:** `ain@anytimefitness.com`
- **Password:** `password123`

## Features
- **Public Website:** Home page, trainer profiles, membership plans, and private coaching details.
- **Member Dashboard:** Members can manage their active plans, book classes, and check their membership status.
- **Trainer Portal:** Trainers can manage their classes and view attendees.
- **Admin Dashboard:** Comprehensive system management for packages, users, bookings, and physical check-ins.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/megatnaufal/gym_membership.git
   ```
2. Run Composer install to download dependencies:
   ```bash
   composer install
   ```
3. Set up your database and configure your `config/app_local.php` file to connect to your local MySQL database.
4. Start the local server:
   ```bash
   bin/cake server -p 8765
   ```
5. Visit `http://localhost:8765` to view the website!

## Requirements
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB database

## Disclaimer
This project is an academic assignment. All Anytime Fitness branding, logos, and trademarks belong to their respective owners and are used here for educational demonstration purposes only.
