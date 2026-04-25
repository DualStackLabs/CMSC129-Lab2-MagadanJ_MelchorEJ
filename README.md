# CMSC129-Lab2-MagadanJ_MelchorEJ
Sample Project Structure:

```bash
personal-journal/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Your controllers (C in MVC)
│   │   ├── Middleware/       # HTTP middleware
│   │   └── Requests/         # Form request validation
│   ├── Models/               # Your models (M in MVC)
│   └── ...
├── database/
│   ├── migrations/           # Database structure
│   ├── seeders/              # Sample data generators
│   └── factories/            # Model factories for testing
├── public/
│   ├── css/                  # Compiled CSS
│   ├── js/                   # Compiled JavaScript
│   └── images/               # Public images
├── resources/
│   ├── views/                # Your Blade templates (V in MVC)
│   │   ├── layouts/          # Master layouts
│   │   ├── components/       # Reusable components
│   │   └── ...
│   ├── css/                  # Source CSS files
│   └── js/                   # Source JavaScript files
├── routes/
│   ├── web.php               # Web routes (main routes for your app)
│   └── api.php               # API routes
├── storage/
│   ├── app/                  # File uploads
│   ├── logs/                 # Application logs
│   └── framework/            # Framework files
├── tests/                    # Application tests
├── .env                      # Environment variables (NOT in Git or I will kill you)
├── .env.example              # Example environment file
├── composer.json             # PHP dependencies
├── package.json              # Node dependencies
└── README.md                 # Your documentation
```

