<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* login */

.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-top: 10px;
}

input {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

/* Styles for smaller screens (e.g., mobile devices) */
@media (max-width: 768px) {
    .login-container {
        max-width: 90%;
    }
}

/* login end */
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="authenticate.php"> <!-- Change action to your authentication script -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
