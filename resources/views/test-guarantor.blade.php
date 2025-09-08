<!DOCTYPE html>
<html>
<head>
    <title>Test Guarantor</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Guarantor Form</h1>
    
    <form id="test-form">
        @csrf
        <div>
            <label>First Guarantor Name:</label>
            <input type="text" name="first_guarantor_name" value="Test First Guarantor">
        </div>
        
        <div>
            <label>First Guarantor Mobile:</label>
            <input type="text" name="first_guarantor_mobile" value="1234567890">
        </div>
        
        <div>
            <label>First Guarantor Relation:</label>
            <input type="text" name="first_guarantor_relation" value="Friend">
        </div>
        
        <div>
            <label>First Guarantor DOB:</label>
            <input type="date" name="first_guarantor_dob" value="1980-01-01">
        </div>
        
        <div>
            <label>First Guarantor Gender:</label>
            <select name="first_guarantor_gender">
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <div>
            <label>First Guarantor Permanent Address:</label>
            <textarea name="first_guarantor_permanent_address">Test Address 1</textarea>
        </div>
        
        <div>
            <label>First Guarantor PAN:</label>
            <input type="text" name="first_guarantor_pan" value="ABCDE1234F">
        </div>
        
        <div>
            <label>First Guarantor Income:</label>
            <input type="number" name="first_guarantor_income" value="50000">
        </div>
        
        <div>
            <label>First Guarantor Email:</label>
            <input type="email" name="first_guarantor_email" value="first@test.com">
        </div>
        
        <div>
            <label>First Guarantor Aadhar:</label>
            <input type="text" name="first_guarantor_aadhar" value="123456789012">
        </div>
        
        <div>
            <label>Second Guarantor Name:</label>
            <input type="text" name="second_guarantor_name" value="Test Second Guarantor">
        </div>
        
        <div>
            <label>Second Guarantor Mobile:</label>
            <input type="text" name="second_guarantor_mobile" value="0987654321">
        </div>
        
        <div>
            <label>Second Guarantor Relation:</label>
            <input type="text" name="second_guarantor_relation" value="Colleague">
        </div>
        
        <div>
            <label>Second Guarantor DOB:</label>
            <input type="date" name="second_guarantor_dob" value="1985-01-01">
        </div>
        
        <div>
            <label>Second Guarantor Gender:</label>
            <select name="second_guarantor_gender">
                <option value="female" selected>Female</option>
                <option value="male">Male</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <div>
            <label>Second Guarantor Permanent Address:</label>
            <textarea name="second_guarantor_permanent_address">Test Address 2</textarea>
        </div>
        
        <div>
            <label>Second Guarantor PAN:</label>
            <input type="text" name="second_guarantor_pan" value="FGHIJ5678K">
        </div>
        
        <div>
            <label>Second Guarantor Income:</label>
            <input type="number" name="second_guarantor_income" value="60000">
        </div>
        
        <div>
            <label>Second Guarantor Email:</label>
            <input type="email" name="second_guarantor_email" value="second@test.com">
        </div>
        
        <div>
            <label>Second Guarantor Aadhar:</label>
            <input type="text" name="second_guarantor_aadhar" value="987654321098">
        </div>
        
        <button type="submit">Submit</button>
    </form>
    
    <div id="result"></div>
    
    <script>
        document.getElementById('test-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/test-guarantor', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            })
            .catch(error => {
                document.getElementById('result').innerHTML = '<p>Error: ' + error.message + '</p>';
            });
        });
    </script>
</body>
</html>