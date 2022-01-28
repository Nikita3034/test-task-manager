## Problem:

    You need to create a task application.
    Tasks consist of:
    - username;
    - e-mail;
    - task text;

    Start page - a list of tasks with the ability to sort by username, email and status. The output of tasks should be done in pages of 3 pieces (with pagination). Any visitor without authorization can see the list of tasks and create new ones.

    Log in for the administrator (login "admin", password "123"). The administrator has the ability to edit the text of the task and check the box for completion. Completed tasks in the general list are displayed with a corresponding mark.

    In the application, you need to implement the MVC model using pure PHP. PHP frameworks cannot be used, libraries can. This application does not need a complex architecture, solve the tasks with the minimum amount of code required. Layout on bootstrap, there are no special requirements for design.

## Solution:

### Database structure:

<img width="393" alt="Screenshot 2022-01-27 at 4 59 19 PM" src="https://user-images.githubusercontent.com/37295991/151373351-a0e30faa-d6c9-412d-bacc-bc1a49ec72e7.png">

### Appearance:

<img width="1112" alt="Screenshot 2022-01-27 at 4 32 17 PM" src="https://user-images.githubusercontent.com/37295991/151371651-a5236d58-9263-4aa1-914b-00f8554e94b6.png">

<img width="1107" alt="Screenshot 2022-01-27 at 4 32 06 PM" src="https://user-images.githubusercontent.com/37295991/151371683-15c81c58-cab3-4329-995d-bda045f9178b.png">

## Project development:

- Clone this project
- Clone docker build from [Docker build](https://github.com/Nikita3034/docker-build) and follow the instructions
- Go to the root of this project
- `cp .env.example .env`
- Create tables according to the presented structure
- Add row in table `users` where  `login = admin` and `password = 123`

## Used technologies:

    php, js (jQuery), css, html