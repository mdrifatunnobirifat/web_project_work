<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Features</title>
<style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f4f4f4;
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
           margin: 0;
       }
       .form-container {
           background-color: white;
           padding: 40px;
           border-radius: 8px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           width: 400px;
       }
       h2 {
           text-align: center;
           color: #333;
       }
       .form-group {
           margin-bottom: 20px;
       }
       label {
           display: block;
           margin-bottom: 8px;
           font-weight: bold;
           color: #555;
       }
       input[type="text"],
       input[type="password"],
       textarea,
       select {
           width: 100%;
           padding: 10px;
           border: 1px solid #ccc;
           border-radius: 4px;
           box-sizing: border-box;
           font-size: 16px;
       }
       textarea {
           resize: vertical;
       }
       button {
           width: 100%;
           padding: 12px;
           background-color: #007BFF;
           border: none;
           border-radius: 4px;
           color: white;
           font-size: 18px;
           font-weight: bold;
           cursor: pointer;
           transition: background-color 0.3s ease;
       }
       button:hover {
           background-color: #0056b3;
       }
</style>
</head>
<body>
<div class="form-container">
<h2>Teacher Features</h2>
<form action="/submit-teacher-features" method="post">
<div class="form-group">
<label for="username">Username:</label>
<input type="text" id="username" name="username" required>
</div>
<div class="form-group">
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
</div>
<div class="form-group">
<label for="new_password">New Password:</label>
<input type="password" id="new_password" name="new_password">
</div>
<div class="form-group">
<label for="profile_name">Full Name:</label>
<input type="text" id="profile_name" name="profile_name">
</div>
<div class="form-group">
<label for="assigned_course">Assigned Course:</label>
<select id="assigned_course" name="assigned_course">
<option value="" disabled selected>Select a course</option>
<option value="math">Mathematics</option>
<option value="science">Science</option>
<option value="history">History</option>
</select>
</div>
<div class="form-group">
<label for="study_material">Upload Study Material:</label>
<input type="file" id="study_material" name="study_material">
</div>
<div class="form-group">
<label for="task_file">Upload Task File:</label>
<input type="file" id="task_file" name="task_file">
</div>
<div class="form-group">
<label for="student_grade">Grade Student:</label>
<input type="text" id="student_grade" name="student_grade" placeholder="Enter student ID and grade">
</div>
<div class="form-group">
<label for="announcement">Announcement:</label>
<textarea id="announcement" name="announcement" rows="4"></textarea>
</div>
<button type="submit">Submit</button>
</form>
</div>
</body>
</html>