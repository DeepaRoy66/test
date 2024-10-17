const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 5000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Create a MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'note_app'
});

// Connect to the database
db.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
        process.exit(1); // Exit process if database connection fails
    }
    console.log('Connected to the MySQL database.');
});

// Handle login request
app.post('/api/login', (req, res) => {
    const { username, password } = req.body;

    // Basic validation
    if (!username || !password) {
        return res.status(400).json({ message: 'Username and password are required.' });
    }

    const query = 'SELECT * FROM db WHERE email = ? AND password = ?';

    db.query(query, [username, password], (err, results) => {
        if (err) {
            console.error('Error querying the database:', err);
            return res.status(500).json({ message: 'An error occurred while querying the database.' });
        }

        if (results.length === 0) {
            return res.status(401).json({ message: 'Invalid username or password.' });
        }

        res.status(200).json({ message: 'Login successful!' });
    });
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});




