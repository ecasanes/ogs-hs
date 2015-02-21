<?php

class Curiculum_Model extends MY_Model {

    //term is grading period

    /* add */
    public function create_grade_level($sy_start, $sy_end, $grade_level){ //grade_level

        $sql  = "INSERT INTO tbl_grade_level (sy_start, sy_end, grade_level) VALUES (?, ?, ?)";

        $escaped_values = array($sy_start, $sy_end, $grade_level);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_section($grade_level_id, $section){

        $sql = "INSERT INTO tbl_grade_section (gl_id, section) VALUES (?, ?)";

        $escaped_values = array($grade_level_id, $section);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function offer_subject($offer_id, $subj_id){

        $sql = "INSERT INTO tbl_subj_offering (offer_id, subj_id) VALUES (?, ?)";

        $escaped_values = array($offer_id, $subj_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function assign_instructor($subj_offerid, $user_id){

        $sql = "INSERT INTO tbl_teacher_subj (subj_offerid, user_id) VALUES (?, ?)";

        $escaped_values = array($subj_offerid, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function enroll_student($offer_id, $user_id){

        $sql = "INSERT INTO tbl_enroll_student (offer_id, user_id) VALUES (?, ?)";

        $escaped_values = array($offer_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function add_project($subj_offerid, $no_of_items, $term, $tag){

        $sql = "INSERT INTO tbl_project (subj_offerid, p_item, term, ptag) VALUES (?, ?, ?, ?)";

        $escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_quiz($subj_offerid, $no_of_items, $term, $tag){

        $sql = "INSERT INTO tbl_quiz (subj_offerid, q_item, term, qtag) VALUES (?, ?, ?, ?)";

        $escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_recitation($subj_offerid, $no_of_items, $term, $tag){

        $sql = "INSERT INTO tbl_recitation (subj_offerid, r_item, term, rtag) VALUES (?, ?, ?, ?)";

        $escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_assignment($subj_offerid, $no_of_items, $term, $tag){

        $sql = "INSERT INTO tbl_assignment (subj_offerid, a_item, term, atag) VALUES (?, ?, ?, ?)";

        $escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_exam($subj_offerid, $no_of_items, $term){

        $sql = "INSERT INTO tbl_exam (subj_offerid, e_item, term) VALUES (?, ?, ?)";

        $escaped_values = array($subj_offerid, $no_of_items, $term);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function assign_student_project($user_id, $activity_id){

        $sql = "INSERT INTO tbl_student_project (user_id, PID) VALUES (?, ?)";

        $escaped_values = array($user_id, $activity_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function assign_student_quiz($user_id, $activity_id){

        $sql = "INSERT INTO tbl_student_quiz (user_id, QID) VALUES (?, ?)";

        $escaped_values = array($user_id, $activity_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function assign_student_recitation($user_id, $activity_id){

        $sql = "INSERT INTO tbl_student_recitation (user_id, RID) VALUES (?, ?)";

        $escaped_values = array($user_id, $activity_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function assign_student_assignment($user_id, $activity_id){

        $sql = "INSERT INTO tbl_student_assignment (user_id, AID) VALUES (?, ?)";

        $escaped_values = array($user_id, $activity_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    public function assign_student_exam($user_id, $activity_id){

        $sql = "INSERT INTO tbl_student_exam (user_id, exam_id) VALUES (?, ?)";

        $escaped_values = array($user_id, $activity_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $this->db->insert_id();

        return $result;
    }

    /* count */
    public function count_school_year($sy_start, $sy_end){

        $sql = "SELECT count(*) as count FROM tbl_grade_level WHERE sy_start = ? AND sy_end = ?";

        $escaped_values = array($sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;

        return $result;
    }

    public function count_grade_level($grade_level, $sy_start, $sy_end){

        $sql = "SELECT count(*) as count FROM tbl_grade_level WHERE grade_level = ? AND sy_start = ? AND sy_end = ?";

        $escaped_values = array($grade_level, $sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;

        return $result;
    }

    public function count_section($grade_level_id, $section){

        $sql = "SELECT count(*) as count FROM tbl_grade_section WHERE gl_id = ? AND section LIKE '%{$section}%'";

        $escaped_values = array($grade_level_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;

        return $result;
    }

    public function count_offered_subject($offer_id, $subj_id){

        $sql = "SELECT count(*) as subject_count FROM tbl_subj_offering WHERE offer_id = ? AND subj_id = ?";

        $escaped_values = array($offer_id, $subj_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->subject_count;

        return $result;
    }

    public function count_assigned_teachers($subj_offerid, $user_id){

        $sql = "SELECT count(*) as assign_count FROM tbl_teacher_subj WHERE subj_offerid = ? AND user_id = ?";

        $escaped_values = array($subj_offerid, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->assign_count;

        return $result;
    }

    public function count_enrolled_students($grade_level_id, $user_id){

        $sql = "SELECT 
              count(*) as count_users 
            FROM
              tbl_enroll_student a,
              tbl_grade_level b,
              tbl_grade_section c 
            WHERE c.`gl_id` = b.`gl_id` 
              AND c.`offer_id` = a.`offer_id` 
              AND b.`gl_id` = ?
              AND a.`user_id` = ?";

        $escaped_values = array($grade_level_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count_users;

        return $result;
    }

    /* get */
    public function get_school_year(){

        $sql = "SELECT DISTINCT(a.sy_start),
              a.* 
            FROM
              tbl_grade_level a 
             GROUP BY sy_start ORDER BY sy_start";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_available_year_level_by_school_year($sy_start, $sy_end){

        $sql = "SELECT * FROM tbl_grade_level WHERE sy_start = ? AND sy_end = ? ORDER BY grade_level";

        $escaped_values = array($sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_sections_by_grade_level($grade_level_id){

        $sql = "SELECT * FROM tbl_grade_section WHERE gl_id = ?";

        $escaped_values = array($grade_level_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level){

        $sql = "SELECT gl_id FROM tbl_grade_level WHERE sy_start = ? AND sy_end = ? AND grade_level = ?";

        $escaped_values = array($sy_start, $sy_end, $grade_level);

        $query = $this->db->query($sql, $escaped_values);

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->gl_id;
        }else {
            $result = 0;
        }

        

        return $result;
    }

    public function get_subjects_by_offer_id($offer_id){
    }

    public function get_subjects_not_assigned_by_detail($grade_level_id, $section_id){ //gl_id, offer_id

        $sql = "SELECT 
                  * 
                FROM
                  tbl_subject ts, tbl_subj_offering so 
                WHERE ts.subj_id NOT IN 
                  (SELECT 
          a.`subj_id`
        FROM
          `tbl_subj_offering` a,
          tbl_grade_level b,
          tbl_grade_section c,
          tbl_teacher_subj d
        WHERE a.`offer_id` = ?
          AND b.`gl_id` = ?
          AND c.`offer_id` = a.`offer_id`
          AND b.`gl_id` = c.`gl_id`
          AND d.`subj_offerid` = a.`subj_offerid`
         ) AND ts.`subj_id` = so.`subj_id` AND so.`offer_id` = ?";

        $escaped_values = array($section_id, $grade_level_id, $section_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_not_offered_by_detail($grade_level_id, $section_id){ //gl_id, offer_id

        $sql = "SELECT 
                  * 
                FROM
                  tbl_subject 
                WHERE subj_id NOT IN 
                  (SELECT 
          a.`subj_id`
        FROM
          `tbl_subj_offering` a,
          tbl_grade_level b,
          tbl_grade_section c
        WHERE a.`offer_id` = ?
          AND b.`gl_id` = ?
          AND c.`offer_id` = a.`offer_id`
          AND b.`gl_id` = c.`gl_id`
          )";

        $escaped_values = array($section_id, $grade_level_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_not_offered($section_id){ //gl_id, offer_id

        $sql = "SELECT 
          * 
        FROM
          tbl_subject 
        WHERE subj_id NOT IN 
          (SELECT 
            a.subj_id 
          FROM
            `tbl_subj_offering` a 
          WHERE a.`offer_id` = ?)";

        $escaped_values = array($section_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_offered($section_id){ //gl_id, offer_id

        $sql = "SELECT 
                *
              FROM
                `tbl_subj_offering` a,
                tbl_subject b
              WHERE a.`offer_id` = ? AND b.`subj_id` = a.`subj_id`";

        $escaped_values = array($section_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_unassigned_instructors_by_subject_offering($section, $subject, $user_type = 2){

        $sql = "SELECT 
              * 
            FROM
              tbl_user a 
            WHERE a.user_type = ? 
              AND a.user_id NOT IN 
              (SELECT 
                ts.`user_id` 
              FROM
                tbl_teacher_subj ts,
                tbl_subj_offering so 
              WHERE ts.`subj_offerid` = so.`subj_offerid`
              AND so.offer_id = ?
              AND so.subj_id = ?)";

        $escaped_values = array($user_type, $section, $subject);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_all_unassigned_instructors(){

        $sql = "SELECT 
              * 
            FROM
              tbl_user a 
            WHERE a.user_type = 2 
              AND a.user_id NOT IN 
              (SELECT 
                ts.`user_id` 
              FROM
                tbl_teacher_subj ts,
                tbl_subj_offering so 
              WHERE ts.`subj_offerid` = so.`subj_offerid`)";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_subject_offerid($offer_id, $subj_id){

        $sql = "SELECT subj_offerid as id FROM tbl_subj_offering WHERE offer_id = ? AND subj_id = ? limit 1";

        $escaped_values = array($offer_id, $subj_id);

        $query = $this->db->query($sql, $escaped_values);

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->id;
        }else {
            $result = 0;
        }

        return $result;
    }

    public function get_subject_offerid_by_enrolled_student($user_id){

        $sql = "SELECT 
              * 
            FROM
              tbl_enroll_student a,
              tbl_subj_offering d
            WHERE a.`offer_id` = d.`offer_id`
            AND a.`user_id` = ?";

        $escaped_values = array($user_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_project_by_subj_offerid($subj_offerid){

        $sql = "SELECT * FROM tbl_assignment a, tbl_student_assignment b WHERE a.`AID` = b.`AID` AND a.subj_offerid = ?";

        $escaped_values = array($subj_offerid);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    /*todo for others */










































    /*function getTermGrade($offer_id,$stud_id,$term){
    
        $sql = "SELECT * FROM tbl_grade_system WHERE offer_id='$offer_id' limit 1";

        $query = $this->db->query($sql);

        $r = $query->row();
    
        $this->pa=$r->wassign/100;
        $this->pd=$r->wattendance/100;
        $this->pr=$r->wrecite/100;
        $this->pe=$r->wtexam/100;
        $this->pq=$r->wquiz/100;
        
        $subjID=$this->getSubjID($offer_id);//get subj_id
        $subj_id=$subjID->subj_id;

        $subjTag=$this->getSubjTag($subj_id);//get subj_tag
        $subj_tag=$subjTag->subj_tag;
        
        if($subj_tag==0) {
            
        $this->qTscr=$this->getQuizTotal($offer_id,$stud_id,$term); 
        $this->qTitem=$this->getQuizItems($offer_id,$term);
        $this->qgrade=$this->ComputeGrade($this->qTscr,$this->qTitem);
                
        $this->aTscr=$this->getAssignTotal($offer_id,$stud_id,$term); 
        $this->aTitem=$this->getAssignItems($offer_id,$term);
        $this->agrade=$this->ComputeGrade($this->aTscr,$this->aTitem);
            
            
        $this->dTscr=$this->getDeptTotal($offer_id,$stud_id,$term); 
        $this->dTitem=$this->getDeptItems($offer_id,$term);
        $this->dgrade=$this->ComputeGrade($this->dTscr,$this->dTitem);
            
        $this->rTscr=$this->getRecTotal($offer_id,$stud_id,$term); 
        $this->rTitem=$this->getRecItems($offer_id,$term);
        $this->rgrade=$this->ComputeGrade($this->rTscr,$this->rTitem);
            
        $this->eTscr=$this->getExamTotal($offer_id,$stud_id,$term); 
        $this->eTitem=$this->getExamItems($offer_id,$term);
        $this->egrade=$this->ComputeGradeExam($this->eTscr,$this->eTitem);
        
        $pqg=$this->qgrade * $this->pq;
        $pag=$this->agrade * $this->pa;
        $pdg=$this->dgrade * $this->pd;
        $prg=$this->rgrade * $this->pr;
        $peg=$this->egrade * $this->pe;
        
        $tgrade=$pqg+$pag+$pdg+$prg+$peg;
        
        return ($tgrade);
        
        }
        
        elseif($subj_tag==1) {
            
        $this->qTscr=$this->getQuizTotal($offer_id,$stud_id,$term); 
        $this->qTitem=$this->getQuizItems($offer_id,$term);
        $this->qgrade=$this->ComputeGrade($this->qTscr,$this->qTitem);
            
        $this->dTscr=$this->getDeptTotal($offer_id,$stud_id,$term); 
        $this->dTitem=$this->getDeptItems($offer_id,$term);
        $this->dgrade=$this->ComputeGrade($this->dTscr,$this->dTitem);
            
        $this->rTscr=$this->getRecTotal($offer_id,$stud_id,$term); 
        $this->rTitem=$this->getRecItems($offer_id,$term);
        $this->rgrade=$this->ComputeGrade($this->rTscr,$this->rTitem);
            
        $this->eTscr=$this->getExamTotal($offer_id,$stud_id,$term); 
        $this->eTitem=$this->getExamItems($offer_id,$term);
        $this->egrade=$this->ComputeGradeExam($this->eTscr,$this->eTitem);
        
        $pqg=$this->qgrade * $this->pq;
        $pdg=$this->dgrade * $this->pd;
        $prg=$this->rgrade * $this->pr;
        $peg=$this->egrade * $this->pe;
        
        $tgrade=$pqg+$pdg+$prg+$peg;
        
        return ($tgrade);
        
        }
        
        elseif($subj_tag==2) {
            
        $this->qTscr=$this->getQuizTotal($offer_id,$stud_id,$term); 
        $this->qTitem=$this->getQuizItems($offer_id,$term);
        $this->qgrade=$this->ComputeGrade($this->qTscr,$this->qTitem);
                
        $this->aTscr=$this->getAssignTotal($offer_id,$stud_id,$term); 
        $this->aTitem=$this->getAssignItems($offer_id,$term);
        $this->agrade=$this->ComputeGrade($this->aTscr,$this->aTitem);
            
            
        $this->dTscr=$this->getDeptTotal($offer_id,$stud_id,$term); 
        $this->dTitem=$this->getDeptItems($offer_id,$term);
        $this->dgrade=$this->ComputeGrade($this->dTscr,$this->dTitem);
            
        $this->rTscr=$this->getObserveTotal($offer_id,$stud_id,$term); 
        $this->rTitem=$this->getObserveItems($offer_id,$term);
        $this->rgrade=$this->ComputeGrade($this->rTscr,$this->rTitem);
        
        $pqg=$this->qgrade * $this->pq;
        $pag=$this->agrade * $this->pa;
        $pdg=$this->dgrade * $this->pd;
        $prg=$this->rgrade * $this->pr;
        
        $tgrade=$pqg+$pag+$pdg+$prg;
        
        return ($tgrade);
        
    }*/



    function getQuizTotal($offer_id,$stud_id,$term){
        
        $sql = "SELECT SUM(qscr) AS ttl FROM tbl_record_quiz WHERE offer_id='$offer_id' AND sid='$stud_id' AND qterm='$term' GROUP BY sid";

        $query = $this->db->query($sql);

        $result = $query->row()->tt1;

        return $result;
    }
    
    function getQuizItems($offer_id,$term){

        $sql = "SELECT SUM(qitems) AS titems FROM tbl_grade_quiz WHERE offer_id='$offer_id' AND term='$term' GROUP BY offer_id";


        $query = $this->db->query($sql);

        $result = $query->row()->titems;   

        return $result; 
    }
    
    function getAssignTotal($offer_id,$stud_id,$term){

        $sql = "SELECT SUM(ascr) AS ttl FROM tbl_record_assign WHERE offer_id='$offer_id' AND sid='$stud_id' AND aterm='$term' GROUP BY sid";
        
        $query = $this->db->query($sql);

        $result = $query->row()->ttl;

        return $result; 
    }
    
    function getAssignItems($offer_id,$term){

        $sql = "SELECT SUM(aitems) AS titems FROM tbl_grade_assign WHERE offer_id='$offer_id' AND term='$term' GROUP BY offer_id";
        
        $query = $this->db->query($sql);

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->titems;
        }else {
            $result = 1;
        }

         

        return $result;         
    }
    
    function getObserveTotal($offer_id,$stud_id,$term){

        $sql = "SELECT scr AS ttl FROM tbl_record_observe WHERE offer_id='$offer_id' AND sid='$stud_id' AND term='$term' GROUP BY sid";

        $query = $this->db->query($sql);

        $result = $query->row()->ttl; 

        return $result;
    }
    
    function getObserveItems($offer_id,$term){

        $sql = "SELECT items AS titems FROM tbl_grade_observe WHERE offer_id='$offer_id' AND term='$term'";

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->titems;
        }else {
            $result = 1;
        }       
    }
    
    function getRecTotal($offer_id,$stud_id,$term){

        $sql = "SELECT SUM(rscr) AS ttl FROM tbl_record_recite WHERE offer_id='$offer_id' AND sid='$stud_id' AND rterm='$term' GROUP BY sid";

        $query = $this->db->query($sql);

        $result = $query->row()->ttl; 

        return $result;
    }   
    
    function getRecItems($offer_id,$term){

        $sql = "SELECT SUM(ritems) AS titems FROM tbl_grade_recite WHERE offer_id='$offer_id' AND term='$term' GROUP BY offer_id ";


        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->titems;
        }else {
            $result = 1;
        }         
        
    }
    
    function getDeptTotal($offer_id,$stud_id,$term){

        $sql = "SELECT scr AS ttl FROM tbl_record_deportment WHERE offer_id='$offer_id' AND sid='$stud_id' AND term='$term' GROUP BY sid";

        $query = $this->db->query($sql);

        $result = $query->row()->ttl; 

        return $result;
    }                                                                                               
    
    function getDeptItems($offer_id,$term){

        $sql = "SELECT items AS titems FROM tbl_grade_deportment WHERE offer_id='$offer_id' AND term='$term'";


        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->titems;
        }else {
            $result = 1;
        }      
    }
    
    function getExamTotal($offer_id,$stud_id,$term){
        switch($term) {
        case 1: $sql = "SELECT  t1exam AS ttl FROM tbl_record_exam WHERE offer_id='$offer_id' AND sid='$stud_id'"; break;
        case 2: $sql = "SELECT  t2exam AS ttl FROM tbl_record_exam WHERE offer_id='$offer_id' AND sid='$stud_id'"; break;
        case 3: $sql = "SELECT  t3exam AS ttl FROM tbl_record_exam WHERE offer_id='$offer_id' AND sid='$stud_id'"; break;
        case 4: $sql = "SELECT  t4exam AS ttl FROM tbl_record_exam WHERE offer_id='$offer_id' AND sid='$stud_id'"; break;
        }
        
        $query = $this->db->query($sql);

        $result = $query->row()->ttl; 

        return $result;
    }
    
    function getExamItems($offer_id,$term){

        $sql = "SELECT eitems AS titems FROM tbl_grade_exam WHERE offer_id='$offer_id' AND eterm='$term'";


        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->titems;
        }else {
            $result = 1;
        }        
    }
    
    
    function ComputeGrade($Tscr,$Titem){

        if ($Tscr==0)
            $grade=0;
        else    
            $grade=($Tscr/$Titem)*40+60;
        
        return($grade);
    }
    
    function ComputeGradeExam($Tscr,$Titem){

        if ($Tscr==0)
            $grade=0;
        else    
            $grade=($Tscr/$Titem)*30+70;
        
        return($grade);
    }
    
    function getSubjID($offer_id){

        $sql = "SELECT subj_id FROM tbl_subject_schedule WHERE offer_id = '$offer_id'";

        $query = $this->db->query($sql);

        $result = $query->row(); 

        return $result;
    }
    
    function getSubjTag($subj_id){

        $sql = "SELECT subj_tag FROM tbl_subject WHERE subj_id = '$subj_id'";

        $query = $this->db->query($sql);

        $result = $query->row(); 

        return $result;
    }

    


}

?>
