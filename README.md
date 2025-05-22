# Newsit Website

A modern news website built with Laravel and Tailwind CSS.

## Features

- User authentication and authorization
- News article management
- Category management
- Comment system
- Admin dashboard
- Responsive design

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd newsit-website
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure your database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Create database
```bash
# Login to MySQL
mysql -u root -p

# Create database
CREATE DATABASE your_database;
```

8. Run migrations and seeders
```bash
# Run migrations
php artisan migrate

# Run seeders to populate initial data
php artisan db:seed
```

9. Start the development server
```bash
php artisan serve
```

10. In a separate terminal, start Vite
```bash
npm run dev
```

## Database Structure

The application uses the following main tables:

- `users`: User accounts and authentication
- `posts`: News articles
- `categories`: Article categories
- `comments`: User comments on articles
- `activities`: User activity logs

## Usage

Visit `http://localhost:8000` in your browser to see the website.

## Admin Access

Default admin credentials:
- Email: admin@example.com
- Password: password

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
