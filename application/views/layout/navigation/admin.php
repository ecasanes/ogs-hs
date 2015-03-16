<!-- START SUBJECT -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-book"></i> Subjects <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?php echo base_url('subject'); ?>"><i class="fa fa-male"></i> Add and Modify Subjects</a>
                </li>
                <li>
                  <a href="<?php echo base_url('subject//assign_subject_grade_level'); ?>"><i class="fa fa-male"></i> Assign Subject to Year Level</a>
                </li>
                <li>
                  <a href="<?php echo base_url('curiculum/offer-subject'); ?>"><i class="fa fa-male"></i> Offer Subject</a>
                </li>
              </ul>
            </li>
            <!-- END SUBJECT -->


          <!-- START INSTRUCTORS -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-male"></i> Instructors <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?php echo base_url('teacher'); ?>"><i class="fa fa-male"></i> Add Instructor</a>
              </li>
              <li>
                <a href="<?php echo base_url('curiculum/assign-instructor'); ?>"><i class="fa fa-male"></i> Assign Instructors</a>
              </li>
            </ul>
          </li>
          <!-- END INSTRUCTORS -->


        <!-- STUDENTS -->
        <li>
          <a href="<?php echo base_url('student'); ?>"><i class="fa fa-users"></i> Students</a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-plus"></i> Assign <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?php echo base_url('curiculum/add-section'); ?>"><i class="fa fa-male"></i> Add Section</a>
            </li>
          </ul>
        </li>
        <!-- END STUDENTS -->


      <!-- START CURICULUM -->
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="fa fa-cog"></i> Curiculum <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('curiculum'); ?>">Manage Curiculum</a></li>
          <li><a href="<?php echo base_url('curiculum/enroll-student'); ?>">Enroll Student</a></li>
          <li><a href="<?php echo base_url('curiculum/grade-lock'); ?>">Lock/Unlock Grades</a></li>
        </ul>
      </li>
    </ul>
    <!-- END CURICULUM -->