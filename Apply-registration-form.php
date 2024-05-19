<?php
   
    require './includes/config.php';

    $user_ID = $_SESSION["Userid"];

    if(isset($_POST["submit"])){
        $Fname = $_POST["first_name"];
        $Mname = $_POST["middle_name"];
        $Lname = $_POST["last_name"];
        $address = $_POST["address"];
        $contact_number = $_POST["contact_number"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $Work_experience = $_POST["work_experience"];
        $checkbox_work = $_POST["desire_work"];
        
        if(empty($Fname)|| empty($Mname) ||empty($Lname)||empty($address)||empty($contact_number)||empty($age)||empty($gender) ||empty($dob)||empty($Work_experience)){
            echo "<script> alert('Fill Up All The Required Fields'); </script>";
        }


        // Check if email is already registered
        $stmt = $conn->prepare("SELECT 1 FROM applications WHERE userID = ?");
        $stmt->bind_param("s", $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        


        if($result->num_rows > 0){
            echo "<script> alert('You Have An Existing Application!'); </script>";
            exit();           
        }
        $target_dir = "images_uploaded/";
        $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(getimagesize($_FILES["imageUpload"]["tmp_name"]) == false) {
            echo "<script> alert('Uploaded File Is Not An Image'); </script>";
            exit();       
        }

        if($_FILES["imageUpload"]["size"] > 5000000) {
            echo "<script> alert('Image Must Be Below 5mb'); </script>";
            exit(); 
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "<script> alert('Only Jpg/Png/Jpeg and Gif Are Allowed'); </script>";
            exit(); 
        }

        $temp = explode(".",$_FILES["imageUpload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;
        if(!move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
            echo "<script> alert('Something Went Wrong Try Again Later'); </script>";
            exit(); 
        }

        $stmt = $conn->prepare("INSERT INTO applications (userID, Fname, Mname, Lname, Address, Contactnumber, Age, Gender, Birthdate, Profilepic, Workexperience) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssss", $user_ID, $Fname, $Mname, $Lname, $address,$contact_number, $age, $gender, $dob, $newfilename, $Work_experience);
        $stmt->execute();
        $stmt->close();


        $stmt = $conn->prepare("SELECT id FROM applications WHERE userID = ?");
        $stmt->bind_param("s", $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $appID = $row['id'];
        $stmt->close();
        foreach($checkbox_work as $Value){
            $stmt = $conn->prepare("INSERT INTO applied_job (applicationID, JobID) VALUES (?,?)");
            $stmt->bind_param("ss", $appID, $Value);
            $stmt->execute();
            $stmt->close();
        }
        echo "<script> alert('Registration Successful'); </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/Apply-registration-form.css">
    <title>Apply Page</title>
</head>
<body>
    <div class="Container">
        <form  enctype="multipart/form-data" method="post">
            <h1>APPLICATION FORM</h1>

            <div class="applicant_name">

                <div class="input-box">
                    <label class="placeholder" for="first_name">First Name</label>
                    <input  autocomplete="off" class="input" type="text" name="first_name" id="first_name" value="" required>
                </div>

                <div class="input-box">
                    <label class="placeholder" for="middle_name">Middle Name</label>
                    <input autocomplete="off" class="input" type="text" name="middle_name" id="middle_name" value="" required>
                </div>
                
                <div class="input-box">
                    <label class="placeholder" for="last_name">Last Name</label>
                    <input autocomplete="off" class="input" type="text" name="last_name" id="last_name" value="" required>
                </div>
                
            </div>

            <div class="email_adress_contact">
                <div class="input-box">
                    <label class="placeholder" for="address">Adress </label>
                    <input class="input" type="address" name="address" id="address" value="" required>
                </div>

                <div class="input-box">
                    <label class="placeholder" for="contact_number">Contact Number </label>
                    <input class="input" type="contact_number" name="contact_number" id="contact_number" value="" required>
                </div>
            </div>
            
            <div class="date_time">
                <div class="input-box">
                    <label class="placeholder" for="age">Age</label>
                    <input class="input" type="age" name="age" id="age" value="" required>
                </div>

                <select class="gender" name="gender" id="gender" required>
                    <option value="" disabled selected hidden>Select Gender</option>
                    <option  value="male">Male</option>
                    <option  value="female">Female</option>
                </select>
                
                <div class="Birth_date">
                    <label class="placeholder" for="dob">Select Birth Date</label>
                    <input type="date" name="dob" id="dob" required>
                </div>
            </div>

            <div class="upload-container">
                <label for="imageUpload" class="upload-label">Upload Photo</label>
                <input name="imageUpload" type="file" id="imageUpload" accept="image/*" required>
                <div class="preview-container">
                    <img id="imagePreview" class="preview-image" src="" alt="Image Preview" style="display:none;">
                </div>
            </div>

            <div class="work_experience">
                <label class="Experience" for="work_experience">Work Experience</label>
                <textarea class="work_experiences" name="work_experience" id="work_experience"></textarea>
            </div>

            <div class="work_desire">
                <label class="Work_h1">Choose your desire work (maximum of 3)</label>

                <div class="available_work">
                <?php 
                    // Check if email is already registered
                    $stmt = $conn->prepare("SELECT id,Jobname FROM jobs ORDER BY Jobname ASC");
                    $stmt->execute();
                    $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                    ?>

                    <div class="work_choices">
                        <input type="checkbox" name="desire_work[]" id="<?php echo $row['Jobname'];?>" value="<?php echo $row['id'];?>" onchange="limitCheckboxes(this)">
                        <label for="<?php echo $row['Jobname'];?>"><?php echo $row['Jobname'];?></label>
                    </div>
                
                <?php
                }
                    $stmt->close();
                ?>
                    
                </div>
            </div>
            
        
            <button name="submit" type="submit" class="bottons">Submit</button>
        </form>
    </div>

    <script src="./Assets/Apply-registration-form.js"></script>
</body>
</html>