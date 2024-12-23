<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Welcome to the Personal Blog Website project, developed using the Yii Framework. This project is a sophisticated, scalable, and maintainable personal blog website, demonstrating modern web development practices and the SCRUM methodology.
    </p>

    <h2>Project Description</h2>
    <p>
        The Personal Blog Website is designed to provide both admin and user functionalities, including comprehensive blog post management and a seamless user experience. The project emphasizes clean architecture, efficient functionality, and scalability.
    </p>

    <h2>🌟 Key Features</h2>
    <ul>
        <li><strong>Admin Capabilities</strong>:
            <ul>
                <li>Comprehensive blog post management</li>
                <li>Create, update, and delete blog posts</li>
                <li>Admin control over content with confirmation mechanisms for deletions</li>
            </ul>
        </li>
        <li><strong>User Experience</strong>:
            <ul>
                <li>Unrestricted post visibility</li>
                <li>Detailed post view with view count tracking</li>
                <li>Responsive and intuitive interface</li>
            </ul>
        </li>
    </ul>

    <h2>🛠 Technology Stack</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Category</th>
            <th>Technologies</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Backend</td>
            <td>Yii Framework (PHP)</td>
        </tr>
        <tr>
            <td>Frontend</td>
            <td>HTML5, CSS3, JavaScript</td>
        </tr>
        <tr>
            <td>Database</td>
            <td>MySQL</td>
        </tr>
        <tr>
            <td>Version Control</td>
            <td>Git (GitHub)</td>
        </tr>
        <tr>
            <td>Diagramming</td>
            <td>draw.io</td>
        </tr>
        </tbody>
    </table>

    <h2>🚀 Installation & Setup</h2>
    <p>To set up the project on your local machine, follow these steps:</p>
    <ol>
        <li>Clone the repository: <code>git clone https://github.com/yourusername/personal-blog-website.git</code></li>
        <li>Install dependencies: <code>composer install</code></li>
        <li>Set up the database:
            <ul>
                <li>Create a new MySQL database</li>
                <li>Configure the database connection in <code>config/db.php</code></li>
                <li>Run database migrations: <code>./yii migrate</code></li>
            </ul>
        </li>
        <li>Start the development server: <code>php -S localhost:8000</code></li>
    </ol>

    <h2>🔍 Project Structure</h2>
    <p>The project follows a modular structure:</p>
    <pre>
    project-root/
    ├── controllers/     # Application logic and request handling
    ├── models/          # Data models and business logic
    ├── views/           # User interface templates
    ├── tests/           # Automated test suites
    └── docs/            # Project documentation and diagrams
    </pre>

    <h2>🏗 SCRUM Development Methodology</h2>
    <p>This project was developed using SCRUM methodology:</p>
    <ul>
        <li><strong>Sprint 1:</strong> Project initialization and basic CRUD implementation</li>
        <li><strong>Sprint 2:</strong> View count tracking and initial testing</li>
        <li><strong>Sprint 3:</strong> Refinement, bug fixing, and final testing</li>
    </ul>

    <h2>🧪 Testing</h2>
    <p>Unit tests ensure comprehensive coverage for CRUD operations, view count functionality, and model validations. Run tests with:</p>
    <pre>./vendor/bin/codecept run</pre>

    <h2>📊 Performance Considerations</h2>
    <ul>
        <li>Efficient database queries</li>
        <li>Minimal computational overhead</li>
        <li>Scalable architecture design</li>
    </ul>

    <h2>🤝 Contributing</h2>
    <p>If you'd like to contribute, fork the repository, create your feature branch, and submit a pull request:</p>
    <pre>
    git checkout -b feature/AmazingFeature
    git commit -m 'Add some AmazingFeature'
    git push origin feature/AmazingFeature
    </pre>

    <h2>👥 Contributors</h2>
    <ul>
        <li><strong>Temurbek Mirzaliev</strong> (Student ID: 39293) – Lead Developer</li>
    </ul>

    <h2>🔗 Project Links</h2>
    <p>GitHub Repository: <a href="https://github.com/Temurbek-2001/personal-blog">https://github.com/Temurbek-2001/personal-blog</a></p>

    <p><strong>Note:</strong> This project is part of the Project IT course, demonstrating the practical application of software development principles.</p>
</div>
