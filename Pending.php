<?php
    include './includes/Adminheader.php';
    include './includes/config.php';
    $user_ID = $_SESSION['Userid'];

?>    


<div class="PENDING_PAGE">
                <?php 
                    // Check if email is already registered
                    $stmt = $conn->prepare("SELECT * 
                        FROM applications A 
                        INNER JOIN applied_job B ON B.applicationID = A.id
                        INNER JOIN jobs C ON C.id = B.JobID
                        INNER JOIN tb_user D ON D.id = A.userID 
                        WHERE A.userID = $user_ID");
                    $stmt->execute();
                    $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                    ?>
                    <div class="resume_sample">
                            <div class="Information_top_part">
                                <div class="Inoformation_part">
                                    <p>Name : <?php echo $row['Fname']." ".$row['Mname']." ".$row['Lname'];?></p>
                                    <p>Age : 21</p>
                                    <p>Birth Date : 2003</p>
                                    <p>Address : #118 7th ave D.Aquino Street Caloocan city</p>
                                    <p>Contact : 0912 345 6789</p>
                                    <p>Email : angbrix@gmail.com</p>
                                    <p>Work Experience : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.
                                    </p>
                                    <p>Desire Job : <?php echo $row['Jobname']?></p>
                                </div>

                                <img class="applicant_image" src="./Image/applicant_sample.png">
                            </div>

                            <div class="decision">
                                    <div class="accepted">
                                        <a class="accept" href="#">ACCEPT</a>
                                    </div>
                                    <div class="rejected">
                                        <a class="reject" href="#">REJECT</a>
                                    </div>
                                </div> 
                            </div>
                    <?php
                    }
                        $stmt->close();
                    ?>

    </div>


    <script src="./Assets/admin.js"></script>
</body>
</html>