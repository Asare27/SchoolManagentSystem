
<div class="menu-inner">
<div style="text-align:center">
    <?php
    @$FileName="";
    @$_Branch="";

    include("dbstring.php");
    $sql ="SELECT * FROM tblsystemuser su INNER JOIN tblbranch br ON su.branchid=br.branchid
     WHERE userid='$_SESSION[USERID]'";
    $result = mysqli_query($con,$sql);
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $FileName = $row['filename'];
    $_Branch=$row['location'];

    if($FileName){
      echo "<img src='uploads/$FileName' width='80px' height='80px' style='border-radius:100%'/><br/><br/>";
      echo "<div style='padding:10px;background-color:transparent;margin-top:-5px;margin-left:-5px;margin-right:-5px;margin-bottom:-5px;border-bottom:0px solid #ccc;color:white;font-size:1em;font-weight:bold'>$_SESSION[FULLNAME]</div>"; 
      echo "<b style='color:lightblue;font-size:10px;padding:10px;'>Uploaded Date/Time:$row[uploadeddatetime]</b>";
    }
    else{
      echo "<img src='uploads/comm.gif' width='80px' height='80px' style='border-radius:100%'/><br/>";
      echo "<div style='padding:10px;background-color:transparent;margin-top:-5px;margin-left:-5px;margin-right:-5px;margin-bottom:-5px;border-bottom:0px solid #ccc;color:white;font-size:1em;font-weight:bold'>$_SESSION[FULLNAME]</div>"; 
      echo "<b style='color:lightblue;font-size:10px'>Image Not Uploaded</b>";
    }
  }
?>

<br/><br/>
<a href="uploaduser-image.php" class="button-pay" title="Open and Upload Your Image"><i  class="fa fa-upload"></i> Upload Image</a>
<br/>

<?php
if( $_SESSION['SYSTEMTYPE']=="normal_user"){
echo "<br/><b style='margin-bottom:10px;font-size:12px;'> Level: Administrator</b><br/><br/>";  
}
elseif( $_SESSION['SYSTEMTYPE']=="super_user"){
echo "<br/><b> Level: Super User</b><br/><br/>"; 
}
else{
echo "<br/><b> Level:". $_SESSION['SYSTEMTYPE'] ."</b><br/><br/>";   
}
echo "<b style='margin-bottom:10px;font-size:12px;'> Branch:". $_Branch ."</b><br/>";
?>
</div>
<hr>
  <a href="edit-account.php" ><i   class="fa fa-edit"></i> Edit Profile </a><br/>
<a href="change-password.php" ><i  class="fa fa-edit"></i> Change Password </a><br/>
<a href="messages.php" ><i  class="fa fa-book"></i> Messages </a><br/>
<hr>

<?php
//session_start();
if($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Teacher"){
?>

<a class="active" href="teacher-page.php"><i class="fa fa-home" ></i> Home</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> SUBJECT</strong><br/>
<a href="view-teacher-subject.php"><i class="fa fa-search" ></i> View Subject(s) Assigned</a><br/>
<hr/>
<strong><i class="fa fa-check" ></i> SCORES</strong><br/>
<a href="class-score-entry.php"><i class="fa fa-pencil" ></i> Class Score Entry</a><br/>
<a href="exam-score-entry.php"><i class="fa fa-pencil" ></i> Exam Score Entry</a><br/>
<a href="upload-class-score-entry.php"><i class="fa fa-upload" ></i> Upload Class Score </a><br/>
<a href="upload-exam-score-entry.php"><i class="fa fa-upload" ></i> Upload Exam Score </a><br/>

<a href="upload-classexam-score.php"><i class="fa fa-upload" ></i> Upload Class & Exam Score </a><br/>
<hr>
<strong><i class="fa fa-check" ></i>DOWNLOADS</strong><br/>
<a href="download-classscore-template.php"><i class="fa fa-download" ></i> Class Score Template </a><br/>
<a href="download-examscore-template.php"><i class="fa fa-download" ></i> Exam Score Template </a><br/>
<a href="download-classexamscore-template.php"><i class="fa fa-download" ></i> Class/Exam Score Template </a><br/>
<hr>
<strong><i class="fa fa-check" ></i> REPORT</strong><br/>
<a href="scores-report.php"><i class="fa fa-book" ></i> Scores Report</a><br/>
<a href="terminal-report.php"> <i class="fa fa-book" ></i> Examination Report</a><br/>
<a href="examinationtimetablereport.php"><i class="fa fa-book" ></i> Exam Time Table Report</a><br/>

<?php
}
else if($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="Student"){
?>
<a href="student-page.php"><i class="fa fa-home" ></i> Home</a><br/>
<br/>
<strong> <i class="fa fa-check" ></i> Accounts</strong><br/>
<a href="bills.php"><i class="fa fa-money" ></i> Bills</a><br/>
<a href="account-statements.php"> <i class="fa fa-money" ></i> Account Statements</a>

 <br/><br/>
<strong><i class="fa fa-check" ></i> RECORDS</strong><br/>
<a href="registeredclass.php"> <i class="fa fa-folder-o" ></i> Registered Class</a><br/>
<a href="registeredsubject.php"> <i class="fa fa-folder-o" ></i> Registered Subject</a>

 <br/><br/>
<strong><i class="fa fa-check" ></i> EXAMINATION</strong><br/>
<a href="examinationtimetablereport.php"><i class="fa fa-folder-o" ></i> Exam Time Table Report</a><br/>
<a href="individual-terminal-report.php"><i class="fa fa-folder-o" ></i> Examination Report</a><br/>
<?php
}
else if($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="super_user"){
 ?>
<a  href="super.php"><i class="fa fa-home" ></i> Home</a><br/>
<a href="company-entry.php"><i class="fa fa-plus" ></i> School Entry</a><br/>
<a href="branch-entry.php"><i class="fa fa-plus" ></i> Branch Entry</a><br/>
 <a href="batch-entry.php"><i class="fa fa-plus" ></i> Batch Entry</a><br/>
<a href="subject-entry.php"><i class="fa fa-plus" ></i> Subject Entry</a><br/>
<a href="class-entry.php"><i class="fa fa-plus" ></i> Class Entry</a><br/>
<a href="school-data-entry.php"><i class="fa fa-plus" ></i> School Data Entry</a><br/>
<br/>
<strong> <i class="fa fa-check" ></i> ACCOUNTS</strong><br/>
<a href="item-entry.php"><i class="fa fa-plus"></i> Item Entry</a><br/>
<a href="item-pricing.php"><i class="fa fa-plus" ></i> Item Pricing</a><br/>
<a href="class-billing.php"><i class="fa fa-plus" ></i> Class Billing</a><br/>
<a href="payments.php"><i class="fa fa-plus" ></i> Payments</a><br/>
<a href="daily-report.php"><i class="fa fa-book" ></i> Daily Report</a><br/>
<a href="payment-analysis.php"><i class="fa fa-book" ></i> Payment Report</a><br/>
<a href="bills-report.php"><i class="fa fa-book" ></i> Bills Report</a><br/><br/>
 
<strong> <i class="fa fa-check"></i> BILLING</strong><br/>
 <a href="student-billing.php"><i class="fa fa-plus" ></i> Bill Student</a><br/>
<!--<a href="rebill-student.php"><i class="fa fa-plus" ></i> Re-Bill Student</a><br/>-->
<a href="group-student-billing.php"><i class="fa fa-plus" ></i> Bill Group Students</a><br/>
<a href="rebill-group-student.php"><i class="fa fa-plus" ></i> Rebill Group Students</a><br/>
<a href="print-student-bills.php"><i class="fa fa-plus" ></i> Print Student Bills</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> RECORDS</strong><br/>
<a href="class-registry.php"><i class="fa fa-plus" ></i> Class Registry</a><br/>
<a href="upload-class-registry.php"><i class="fa fa-upload" ></i>Upload Class Registry</a><br/>
<a href="view-class-registry.php"><i class="fa fa-upload" ></i> View Class Registry</a><br/>

<hr>
<a href="term-registry.php"><i class="fa fa-plus" ></i> Semester Registry</a><br/>
<a href="group-term-registry.php"><i class="fa fa-plus" ></i> Group Semester Registry</a><br/>
<a href="upload-semester-registry.php"><i class="fa fa-upload" ></i>Upload Semester Registry</a><br/>          
<br/>
<strong><i class="fa fa-check" ></i> SUBJECT</strong><br/>
<div class="menu-inner">
<a href="subject-classification.php"><i class="fa fa-plus" ></i> Subject Classification</a><br/>
<a href="view-subject-classified.php"><i class="fa fa-plus" ></i> View Subject Classified</a><br/>
<a href="subject-assignment.php"><i class="fa fa-plus" ></i> Subject Assignment</a><br/>
<a href="view-all-subject-assigned.php"><i class="fa fa-plus" ></i> View Subject(s) Assigned</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> EXAMINATION</strong><br/>
<!--
<a href="all-class-score.php"><i class="fa fa-plus" ></i> Class Score</a><br/>
<a href="exam-score.php"><i class="fa fa-plus" ></i> Exam Score</a><br/>
<a href="student-terminal-data.php"><i class="fa fa-plus" ></i> Student Remark Data</a><br/>
<a href="upload-student-remark-data.php"><i class="fa fa-upload" ></i>Upload Students Remark Data</a><br/>
-->
<hr>
<a href="class-score-entry.php"><i class="fa fa-pencil" ></i> Class Score Entry</a><br/>
<a href="exam-score-entry.php"><i class="fa fa-pencil" ></i> Exam Score Entry</a><br/>
<a href="upload-class-score-entry.php"><i class="fa fa-upload" ></i> Upload Class Score </a><br/>
<a href="upload-exam-score-entry.php"><i class="fa fa-upload" ></i> Upload Exam Score </a><br/>
<a href="upload-classexam-score.php"><i class="fa fa-upload" ></i> Upload Class & Exam Scores </a><br/>

<hr>
<a href="scores-report.php"><i class="fa fa-book" ></i> Scores Report</a><br/>
<a href="terminal-report.php"><i class="fa fa-book" ></i> Examination Report</a><br/>
<a href="examanalysis.php"><i class="fa fa-folder-o" ></i> Exams Analysis:Grade Statistics</a><br/>
<a href="examanalysis-subject.php"><i class="fa fa-folder-o" ></i> Exam Analysis : Subject</a><br/>
<a href="examanalysis-rank.php"><i class="fa fa-folder-o" ></i> Exam Analysis : Rank</a><br/>
<a href="enablesmsalert.php"><i class="fa fa-phone" ></i> Enable SMS Alert</a><br/>
<a href="smsreport.php"><i class="fa fa-phone" ></i> SMS Reporting</a><br/>
<a href="smsreportdata.php"><i class="fa fa-database" ></i> SMS Data</a><br/>

<hr>
<a href="examinationtimetable.php"><i class="fa fa-plus" ></i> Exam Time Table Entry</a><br/>
<a href="examinationtimetablereport.php"><i class="fa fa-book" ></i> Exam Time Table Report</a><br/>
<br/>

<strong><i class="fa fa-check" ></i> Notice</strong><br/>
<a href="notification.php"><i class="fa fa-plus" ></i> Send Notification</a><br/>

<?php
}
else if($_SESSION['ACCESSLEVEL']=="administrator" && $_SESSION['SYSTEMTYPE']=="normal_user"){
 ?>
<a href="admin.php"><i class="fa fa-home" ></i> Home</a><br/>
<a href="company-entry.php"><i class="fa fa-plus" ></i> School Entry</a><br/>
<a href="branch-entry.php"><i class="fa fa-plus" ></i> Branch Entry</a><br/>
<a href="batch-entry.php"><i class="fa fa-plus" ></i> Batch Entry</a><br/>
<a href="subject-entry.php"><i class="fa fa-plus" ></i> Subject Entry</a><br/>
<a href="class-entry.php"><i class="fa fa-plus" ></i> Class Entry</a><br/>
<a href="school-data-entry.php"><i class="fa fa-plus" ></i> School Data Entry</a><br/>
<br/>
<strong> <i class="fa fa-check"></i> BILLING</strong><br/>
 <a href="student-billing.php"><i class="fa fa-plus" ></i> Bill Student</a><br/>
<!--<a href="rebill-student.php"><i class="fa fa-plus" ></i> Re-Bill Student</a><br/>-->
<a href="group-student-billing.php"><i class="fa fa-plus" ></i> Bill Group Students</a><br/>
<a href="rebill-group-student.php"><i class="fa fa-plus" ></i> Rebill Group Students</a><br/>
<a href="print-student-bills.php"><i class="fa fa-plus" ></i> Print Student Bills</a><br/>
<br/>
<strong> <i class="fa fa-check" ></i> ACCOUNTS</strong><br/>
<a href="item-entry.php"><i class="fa fa-plus"></i> Item Entry</a><br/>
<a href="item-pricing.php"><i class="fa fa-plus" ></i> Item Pricing</a><br/>
<a href="class-billing.php"><i class="fa fa-plus" ></i> Class Billing</a><br/>
<a href="payments.php"><i class="fa fa-plus" ></i> Payments</a><br/>
<a href="daily-report.php"><i class="fa fa-book" ></i> Daily Report</a><br/>
<a href="payment-analysis.php"><i class="fa fa-book" ></i> Payment Report</a><br/>
<a href="bills-report.php"><i class="fa fa-book" ></i> Bills Report</a><br/>
<a href="item-bill-report.php"><i class="fa fa-book" ></i> Item Bill Report</a><br/><br/>
 
<strong><i class="fa fa-check" ></i> RECORDS</strong><br/>
<a href="class-registry.php"><i class="fa fa-plus" ></i> Class Registry</a><br/>
<a href="upload-class-registry.php"><i class="fa fa-upload" ></i> Upload Class Registry</a><br/>
<a href="view-class-registry.php"><i class="fa fa-upload" ></i> View Class Registry</a><br/>

<hr>
<a href="term-registry.php"><i class="fa fa-plus" ></i> Semester Registry</a><br/>
<a href="group-term-registry.php"><i class="fa fa-plus" ></i> Group Semester Registry</a><br/>
<a href="upload-semester-registry.php"><i class="fa fa-upload" ></i> Upload Semester Registry</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> SUBJECT</strong><br/>

<a href="subject-classification.php"><i class="fa fa-plus" ></i> Subject Classification</a><br/>
<a href="view-subject-classified.php"><i class="fa fa-book" ></i> View Subject Classified</a><br/>
<a href="subject-assignment.php"><i class="fa fa-plus" ></i> Subject Assignment</a><br/>
<a href="view-all-subject-assigned.php"><i class="fa fa-book" ></i> View Subject(s) Assigned</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> EXAMINATION</strong><br/>
<a href="student-terminal-data.php"><i class="fa fa-plus" ></i> Student Remark Data</a><br/>
<a href="upload-student-remark-data.php"><i class="fa fa-upload" ></i>Upload Students Remark Data</a><br/>
<a href="continuous-assessment.php"><i class="fa fa-folder-o" ></i> Continuous Assessment</a><br/>
<a href="scores-report-all.php"><i class="fa fa-folder-o" ></i> Scores Report</a><br/>

<a href="terminal-report.php"><i class="fa fa-folder-o" ></i> Examination Report</a><br/>
<a href="examanalysis.php"><i class="fa fa-folder-o" ></i> Exams Analysis:Statistics</a><br/>
<a href="examanalysis-subject.php"><i class="fa fa-folder-o" ></i> Exam Analysis : Subject</a><br/>
<a href="examanalysis-rank.php"><i class="fa fa-folder-o" ></i> Exam Analysis : Rank</a><br/>

<hr>
<a href="enablesmsalert.php"><i class="fa fa-phone" ></i> Enable SMS Alert</a><br/>

<a href="smsreport.php"><i class="fa fa-phone" ></i> SMS Reporting</a><br/>
<a href="smsreportdata.php"><i class="fa fa-database" ></i> SMS Data</a><br/>

<a href="examinationtimetable.php"><i class="fa fa-plus" ></i> Exam Time Table Entry</a><br/>
<a href="examinationtimetablereport.php"><i class="fa fa-book" ></i> Exam Time Table Report</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> Notice</strong><br/>
<a href="notification.php"><i class="fa fa-plus" ></i> Send Notification</a><br/>
<?php

}
else if($_SESSION['ACCESSLEVEL']=="user" && $_SESSION['SYSTEMTYPE']=="User"){
 ?>
<a class="active" href="user.php"><i class="fa fa-home" ></i> Home</a><br/>
<a href="batch-entry.php"><i class="fa fa-plus" ></i> Batch Entry</a><br/>
<a href="subject-entry.php"><i class="fa fa-plus" ></i> Subject Entry</a><br/>
<a href="class-entry.php"><i class="fa fa-plus" ></i> Class Entry</a><br/>
<a href="school-data-entry.php"><i class="fa fa-plus" ></i> School Data Entry</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> RECORDS</strong><br/>
<a href="class-registry.php"><i class="fa fa-plus" ></i> Class Registry</a><br/>
<a href="upload-class-registry.php"><i class="fa fa-upload" ></i> Upload Class Registry</a><br/>
<a href="view-class-registry.php"><i class="fa fa-upload" ></i> View Class Registry</a><br/>

<hr>

<a href="term-registry.php"><i class="fa fa-plus" ></i> Semester Registry</a><br/>
<a href="group-term-registry.php"><i class="fa fa-plus" ></i> Group Semester Registry</a><br/>
<a href="upload-semester-registry.php"><i class="fa fa-upload" ></i> Upload Semester Registry</a><br/>

<br/><strong><i class="fa fa-check" ></i> TOOLS</strong><br/>
<a href="smsreport.php"><i class="fa fa-plus" ></i> SMS Reporting</a><br/>
<a href="subject-classification.php"><i class="fa fa-plus" ></i> Subject Classification</a><br/>
<a href="view-subject-classified.php"><i class="fa fa-plus" ></i> View Subject Classified</a><br/>
<a href="subject-assignment.php"><i class="fa fa-plus" ></i> Subject Assignment</a><br/>
<a href="view-all-subject-assigned.php"><i class="fa fa-plus" ></i> View Subject(s) Assigned</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> EXAMINATION</strong><br/>
<a href="examinationtimetable.php"><i class="fa fa-plus" ></i> Exam Time Table Entry</a><br/>
<a href="examinationtimetablereport.php"><i class="fa fa-book" ></i> Exam Time Table Report</a><br/>
<a href="student-terminal-data.php"><i class="fa fa-plus" ></i> Student Terminal Data</a><br/>
<a href="terminal-report.php"><i class="fa fa-book" ></i> Examination Report</a><br/>
<a href="scores-report.php"><i class="fa fa-book" ></i> Scores Report</a><br/>
<br/>
<strong><i class="fa fa-check" ></i> Notice</strong><br/>
<a href="notification.php"><i class="fa fa-plus" ></i> Send Notification</a><br/>
<?php
}
?>
</div>