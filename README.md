# Personal Blog Website (Yii Framework)

## Project Description

A sophisticated personal blog website developed using the Yii Framework, showcasing modern web development practices and adherence to SCRUM methodological principles. This project demonstrates a comprehensive approach to building a scalable, maintainable web application with a focus on clean architecture and efficient functionality.

## 🌟 Key Features

### Admin Capabilities
- Comprehensive blog post management
  - Create new blog posts with rich text editing
  - Update existing posts seamlessly
  - Delete posts with confirmation mechanisms
- Full administrative control over content

### User Experience
- Unrestricted post visibility
- Detailed post view with view count tracking
- Responsive and intuitive interface

### Technical Highlights
- Robust view count tracking mechanism
- Clean, modular code structure
- Comprehensive unit testing

## 🛠 Technology Stack

| Category | Technologies |
|----------|--------------|
| Backend | Yii Framework (PHP) |
| Frontend | HTML, CSS, JavaScript |
| Database | MySQL |
| Version Control | Git (GitHub) |
| Diagramming | draw.io |

## 📦 Prerequisites

Before you begin, ensure you have the following installed:
- PHP 7.4 or higher
- Composer
- MySQL 5.7 or higher
- Git

## 🚀 Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/Temurbek-2001/personal-blog-website.git
cd personal-blog-website
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Database Configuration
1. Create a new MySQL database
2. Configure database connection in `config/db.php`
3. Run database migrations:
```bash
./yii migrate
```

### 4. Start the Development Server
```bash
php -S localhost:8000
```

## 🔍 Project Structure

```
project-root/
│
├── controllers/     # Application logic and request handling
├── models/          # Data models and business logic
├── views/           # User interface templates
├── tests/           # Automated test suites
└── docs/            # Project documentation and diagrams
```

## 🏗 SCRUM Development Methodology

### Sprint Breakdown

| Sprint | Focus |
|--------|-------|
| Sprint 1 | Project initialization and basic CRUD implementation |
| Sprint 2 | View count tracking and initial testing |
| Sprint 3 | Refinement, bug fixing, and final testing |

### Project Management
- Comprehensive task tracking using JIRA
- Regular sprint retrospectives
- Continuous integration practices

## 🧪 Testing

### Unit Testing
Comprehensive test coverage for:
- CRUD operations
- View count functionality
- Model validations

#### Running Tests
```bash
./vendor/bin/codecept run
```

## 📊 Performance Considerations
- Efficient database queries
- Minimal computational overhead
- Scalable architecture design

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a pull request



## 👥 Contributors

- **Temurbek Mirzaliev**
  - Student ID: `39293`
  - Role: Lead Developer

## 🔗 Project Links
- GitHub Repository: (https://github.com/Temurbek-2001/personal-blog)

**Note:** This project is developed as part of the Project IT course, demonstrating practical application of software development principles.
