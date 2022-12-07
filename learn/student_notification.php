

<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar_student.php'); ?>
    
    <div class="container-fluid">
        <div class="row-fluid">
            
                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <?php
                            $school_year_query = mysql_query("select * from school_year order by school_year DESC")or die(mysql_error());
                            $school_year_query_row = mysql_fetch_array($school_year_query);
                            $school_year = $school_year_query_row['school_year'];
                        ?>
                        <li><a href="#"><b>My Class</b></a><span class="divider">/</span></li>
                        <li><a href="#">School Year: <?php echo $school_year_query_row['school_year']; ?></a></li>
            </ul>
            <!-- end breadcrumb -->
            
            <div class="span3" id="sidebar">
                <?php include('student_notification_sidebar.php'); ?>
            </div>
            <div class="span5" id="content">
                <div class="post-cont">
                    <div class="row-fluid">
                        <div class="span11">
                            <textarea class="form-control"></textarea>
                            <div class="">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="margin-20"></div>
                    <div class="row-fluid timeline-post">
                        <div class="span2">
                            <img src="admin/uploads/1065-IMG_2529.jpg" alt="post pro pic" class="img-responsive" style="max-width:45px;">
                        </div>
                        <div class="span10">
                            <p>Fazlan Mohammed</p>
                            <div class="post-time-date">
                                2015.08.24 | 06:10 AM
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid timeline-post">
                        <div class="span2">
                            
                        </div>
                        <div class="span10">
                            <div class="post-box">
                                <p class="text-justify">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                                    standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a 
                                    type specimen book. It has survived not only five centuries
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="post-cont">
                    <div class="row-fluid timeline-post">
                        <div class="span2">
                            <img src="admin/uploads/10468092_765698463487021_5126932027540580087_n.jpg" alt="post pro pic" class="img-responsive" style="max-width:45px;">
                        </div>
                        <div class="span10">
                            <p>Asif Yoosuf</p>
                            <div class="post-time-date">
                                2015.08.24 | 06:10 AM
                            </div>
                        </div>
                    </div>
                <div class="row-fluid timeline-post">
                    <div class="span2">
                        
                    </div>
                    <div class="span10">
                        <div class="post-box">
                            <p class="text-justify">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a 
                                type specimen book. It has survived not only five centuries
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="post-cont">
                    <div class="row-fluid timeline-post">
                        <div class="span2">
                            <img src="admin/uploads/1065-IMG_2529.jpg" alt="post pro pic" class="img-responsive" style="max-width:45px;">
                        </div>
                        <div class="span10">
                            <p>Fazlan Mohammed</p>
                            <div class="post-time-date">
                                2015.08.24 | 06:10 AM
                            </div>
                        </div>
                    </div>
                <div class="row-fluid timeline-post">
                    <div class="span2">
                        
                    </div>
                    <div class="span10">
                        <div class="post-box">
                            <p class="text-justify">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a 
                                type specimen book. It has survived not only five centuries
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                
                
            </div>
            
            <div class="span4" id="content">
                <div class="row-fluid">
                    
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left"></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <form action="read.php" method="post">
                                    <?php if($not_read == '0'){
                                        }else{ ?>
                                    <button id="delete"  class="btn btn-info" name="read"><i class="icon-check"></i> Read</button>
                                    <div class="pull-right">
                                        Check All <input type="checkbox"  name="selectAll" id="checkAll" />
                                        <script>
                                            $("#checkAll").click(function () {
                                            	$('input:checkbox').not(this).prop('checked', this.checked);
                                            });
                                        </script>					
                                    </div>
                                    <?php } ?>
                                    <?php $query = mysql_query("select * from teacher_class_student
                                        LEFT JOIN teacher_class ON teacher_class.teacher_class_id = teacher_class_student.teacher_class_id 
                                        LEFT JOIN class ON class.class_id = teacher_class.class_id 
                                        LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
                                        LEFT JOIN teacher ON teacher.teacher_id = teacher_class_student.teacher_id 
                                        JOIN notification ON notification.teacher_class_id = teacher_class.teacher_class_id 	
                                        where teacher_class_student.student_id = '$session_id' and school_year = '$school_year'  order by notification.date_of_notification DESC
                                        ")or die(mysql_error());
                                        $count = mysql_num_rows($query);
                                        if ($count  > 0){
                                        while($row = mysql_fetch_array($query)){
                                        $get_id = $row['teacher_class_id'];
                                        $id = $row['notification_id'];
                                        
                                        
                                        $query_yes_read = mysql_query("select * from notification_read where notification_id = '$id' and student_id = '$session_id'")or die(mysql_error());
                                        $read_row = mysql_fetch_array($query_yes_read);
                                        
                                        $yes = $read_row['student_read'];
                                        
                                        ?>
                                    <div class="post"  id="del<?php echo $id; ?>">
                                        <?php if ($yes == 'yes'){
                                            }else{
                                            ?>
                                        <input id="" class="" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
                                        <?php } ?>	
                                        <strong><?php echo $row['firstname']." ".$row['lastname'];  ?></strong>
                                        <?php echo $row['notification']; ?> In 
                                        <a href="<?php echo $row['link']; ?><?php echo '?id='.$get_id; ?>">
                                        <?php echo $row['class_name']; ?> 
                                        <?php echo $row['subject_code']; ?> 
                                        </a>
                                        <hr>
                                        <div class="pull-right">
                                            <i class="icon-calendar"></i>&nbsp;<?php echo $row['date_of_notification']; ?> 
                                        </div>
                                    </div>
                                    <?php
                                        } }else{
                                        ?>
                                    <div class="alert alert-info"><strong><i class="icon-info-sign"></i> No Notifications Found</strong></div>
                                    <?php
                                        }
                                        ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>
</html>

