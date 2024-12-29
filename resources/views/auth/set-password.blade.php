<!DOCTYPE html>
<html>
<head>
    <style>
        .input-style-1 {
            margin-bottom: 15px;
        }
        .input-style-1 input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-submit {
            background: #4A6CF7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Set Your Password</h2>
    <p>Please set your password to complete registration:</p>

    <form action="{{ route('complete.registration', ['email' => $encodedEmail]) }}" method="POST">
        @csrf
        <div class="input-style-1">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <div class="input-style-1">
            <label>Confirm Password</label><br>
            <input type="password" name="confirmPassword" required>
        </div>

        <button type="submit" class="btn-submit">Set Password</button>
    </form>
</body>
</html>