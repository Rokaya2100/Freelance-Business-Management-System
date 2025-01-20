# # # Freelance_Business_Management_Project

## Project Description
This project allows you to obtain freelance work with minimal effort. You can log in as a freelancer and search for your specialty by selecting it from the categories available on the site. You can then look for projects that match your skills and experience and submit proposals to clients. Additionally, it facilitates clients in finding freelancers to execute their projects with high expertise and enables them to monitor project execution after the contract is signed between the client and the freelancer.

## Requirements
- PHP
- Composer
- MySQL

We have used various packages to build the project, such as:
- laravel/ui
- Spatie
- maatwebsite/excel
- laravel/sanctum

## Installation
To run the project, you need to clone the repository and execute the following commands:

1. Clone the repository:
    
2. Install dependencies using Composer:
    1. composer install
    2. cp .env.example .env
    3. php artisan key:generate
    4. php artisan migrate
    5. php artisan serve


## Features

### Client Side
- Add a project with a description and set a delivery date.
- Edit the project.
- Delete the project and restore it if needed.
- Change the proposal status from pending to accepted and reject other proposals.
- Rate the freelancer.
- Rate the project upon completion and leave comments.

### Freelancer Side
- Submit proposals for projects that match their expertise.
- Update the project status and indicate how much of the project has been completed, including whether the client has paid them or not.

## Workflow
After the client accepts a freelancer's proposal for their project, an automatic contract is created between the client and freelancer for this project. The contract status remains "in progress" until the project is completed and the contract ends.

## Admin
The admin can view all projects, proposals, ratings, and comments on each project. They can also track the status of projects, contracts, categories, and users, including which accounts have logged in—whether they are clients or freelancers.

## collection link:
https://documenter.getpostman.com/view/36486745/2sAYQcFAc2
