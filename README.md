# 🎓 University Course and Result Management System


## 📋 System Requirements

Before starting, ensure you have the following installed:

- **PHP** `^8.2`
- **Composer** - [Download here](https://getcomposer.org)
- **Node.js & NPM** - [Download here](https://nodejs.org)
- **MySQL Database** (XAMPP, WAMP, or standalone)
- **Git** - [Download here](https://git-scm.com)
- **Code Editor** (VS Code, PhpStorm, or similar)
- **GitHub Access** with write permissions to the repository

---

## 🚀 Quick Start Guide

### 1. Clone the Repository
```bash
git clone https://github.com/sakibskb143/University-Course-and-Result-Management-System.git
cd University-Course-and-Result-Management-System
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Configuration

Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=university_crms_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Initialize Database & Assets
```bash
# Run database migrations
php artisan migrate

# Create storage symbolic link
php artisan storage:link

# Compile frontend assets
npm run build
```

### 5. Start Development Server
```bash
php artisan serve
```

Your application will be available at: `http://localhost:8000`

---

## 🔄 Git Collaboration Workflow

### Starting a New Feature

1. **Create and switch to feature branch:**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes and commit:**
   ```bash
   git add .
   git commit -m "Add: descriptive message about your changes"
   ```

3. **Push your branch to GitHub:**
   ```bash
   git push origin feature/your-feature-name
   ```

### Creating a Pull Request

1. Navigate to the GitHub repository
2. Click on your pushed branch
3. Click **"Compare & pull request"**
4. Add a clear title and detailed description
5. Set base branch to `main`
6. Click **"Create pull request"**

### Staying Synchronized

```bash
# Switch to main branch
git checkout main

# Pull latest changes
git pull origin main

# Clean up completed feature branch (optional)
git branch -d feature/your-feature-name
```

### Troubleshooting Commands

```bash
# Check current status
git status

# Verify remote repository URL
git remote -v

# Pull latest changes from main
git pull origin main

# Stage specific files after resolving conflicts
git add <filename>

# Commit after resolving merge conflicts
git commit

# Remove cached files (useful after updating .gitignore)
git rm -r --cached .
git add .
```

---

## ⚙️ Technology Stack

| Category | Technology |
|----------|------------|
| **Backend Framework** | Laravel 11 |
| **Database** | MySQL |
| **Frontend** | CSS, Bootstrap, JavaScript |
| **Template Engine** | Blade |
| **Package Management** | Composer (PHP), NPM (Node.js) |
| **Version Control** | Git & GitHub |

---

## 👥 Development Team

| Name | Role | Primary Responsibilities |
|------|------|-------------------------|
| **MD Sakib** | Team Lead | Full Stack Development, Project Management, Code Review |
| **Fariha Rashid Noha** | Frontend Developer | UI/UX Implementation, Blade Templates, Responsive Design |
| **Maisha** | Backend Developer | API Development, Database Migrations, Controllers |
| **Tuhi** | Database Developer | Database Seeders, Feature Implementation, Data Management |

---

## ⚠️ Important Development Guidelines

### File Management
- ❌ **Never commit** `.env` files or `/vendor` directory
- ❌ **Never commit** `/node_modules` directory
- ✅ **Always** add sensitive files to `.gitignore`

### Best Practices
- 🔄 **Pull from main frequently** to avoid merge conflicts
- 📝 **Use descriptive commit messages** (e.g., "Fix: user authentication bug", "Add: course enrollment feature")
- 🌿 **Use clear branch names** (e.g., `feature/user-dashboard`, `fix/login-validation`)
- 📋 **Test your code** before pushing to avoid breaking changes
- 💬 **Document your changes** in pull request descriptions

### Commit Message Convention
```bash
# Format: Type: Description
git commit -m "Add: new student enrollment feature"
git commit -m "Fix: course deletion validation error"
git commit -m "Update: user dashboard UI components"
git commit -m "Remove: deprecated exam result methods"
```

---

## 📚 Additional Resources

- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Git Collaboration Guide](https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows)
- [Composer Documentation](https://getcomposer.org/doc/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)

---

## 🆘 Getting Help

If you encounter issues:
1. Check this documentation first
2. Search existing GitHub issues
3. Ask team members in your communication channel
4. Create a new GitHub issue with detailed description

---



## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add: some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Support

For support and questions:
- 📧 Email: [sakibskb143@gmail.com](mailto:sakibskb143@gmail.com)
- 🐛 Issues: [GitHub Issues](https://github.com/sakibskb143/University-Course-and-Result-Management-System/issues)

---

**Made with ❤️ by the University CRMS Team**
