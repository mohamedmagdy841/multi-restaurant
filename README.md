# Multi-Restaurant Food Ordering System

This project is a multi-restaurant food ordering system with advanced features like multi-authentication, stripe payment gateway, and order management
all built with Docker for reliable deployment.

## Database Schema
![drawSQL-image-export-2024-11-11](https://github.com/user-attachments/assets/bcf376ad-2b2b-43ef-b600-9cb43878ca5d)

## Key Features

- **Multi-Authentication**: Implemented role-based authentication for Users, Restaurants, and Admins.
  
- **Stripe Payment Integration**: Integrated Stripe as the online payment gateway for secure and seamless payments.

- **Restaurant Favorites**: Added a feature to mark restaurants as favorites, allowing users to quickly access their preferred choices.

- **Advanced Cart Management**: Built a custom shopping cart system without relying on third-party packages, handling complex cart operations, discounts, and promotions.

- **Order Invoicing with PDF Generation**: Developed an automated invoicing feature that generates order receipts in PDF format for easy download and sharing.

- **Dynamic Email Configurations**: Enabled custom email configurations for notifications and confirmations, improving communication between restaurants and users.

- **Dockerized Project Setup**: Fully containerized the application with Docker to standardize the development environment, making it easy to deploy and scale.

## Technologies Used

- **Laravel 11**: Core framework for building and managing the application.
- **Docker**: For containerizing the application, ensuring consistency across development and production environments.
- **Stripe**: Online payment integration for secure transactions.
- **Laravel Breeze**: Utilized for multi-authentication setup, streamlining the login and registration process.
- **PDF Generation Libraries**: Used to create order invoices in PDF format for convenient order tracking.

## Docker and Deployment

<p align="center"><a href="https://www.docker.com/" target="_blank"><img src="https://github.com/user-attachments/assets/1511730a-e1cb-4a3f-b605-8f35cad40027" width="400" alt="Docker Logo"></a></p>

- The project is fully Dockerized using **Docker** and **Docker Compose** to ensure it runs consistently across all environments.
- Apache and MySQL services are configured within Docker containers, and Laravel is served from the `/public` directory.

## Getting Started

To run this project locally:

1. **Clone the Repository**
2. **Set up Docker**: Ensure Docker is installed and run `docker-compose up` to start the containerized environment.
3. **Configure Environment**: Set up `.env` file for database, Stripe API keys, and email configurations.
4. **Run Migrations and Seeders**: 
   ```bash
   php artisan migrate --seed
   ```
5. **Access Application**: Navigate to `http://localhost` to start using the application.

## Project Demo
https://github.com/user-attachments/assets/efb3ce42-54c3-404f-ba11-cf447dd69918

