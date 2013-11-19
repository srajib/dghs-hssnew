    <?php

$no_of_question = 53;

function getAllAnswer($additoinalQueryString = '') {
    $sql = "SELECT * FROM hss_answer_storage $additoinalQueryString";
    $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
    $a = mysql_fetch_rowsarr($r); // stores result in array
    myprint_r($a); // shows the array - debugg
    return $a;
}

function getAnswerRows($org_code, $additoinalQueryString = '') {
    if ($strlen($org_code) && orgCodeValid($org_code)) {
        $sql = "SELECT * FROM hss_answer_storage $additoinalQueryString WHERE answer_storage_org_id='$org_code' $additionalQuery";
        $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
        $a = mysql_fetch_rowsarr($r); // stores result in array
        //myprint_r($a); // shows the array
        return $a;
    }
    return false;
}

function countAllAnswerFrmOrg($org_code, $month, $year, $answersToBeCountedArray, $additoinalQueryString = '') {
    //$month = str_pad($month, 2, '0', STR_PAD_LEFT);
    if(strlen($month)<2){
        $month="0".$month;
    }
    $question_count = getQuestionCount();

    if (strlen($org_code) && orgCodeValid($org_code) && strlen($month) && strlen($year)) {
        $sql = "SELECT * FROM hss_answer_storage WHERE answer_storage_org_id='$org_code' AND answer_storage_month_year='$month-$year' $additoinalQueryString ";
        $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
        $a = mysql_fetch_rowsarr($r); // stores result in array
        //myprint_r($a); 
        $ans_count = 0;
        foreach ($a as $ans) {
            for ($i = 1; $i <= $question_count; $i++) {
                if (in_array($ans["answer_storage_q" . $i . "_answer"], $answersToBeCountedArray)) {
                    if (questionNoBelongsToOrg($i, $org_code)) {
                        //echo "answer_storage_q" . $i . "_answer = Yes <br/>"; // debug
                        $ans_count++;
                    }
                }
            }
        }
        return $ans_count;
    }
    return false;
}

function countAllAnswerFrmOrgTar($org_code, $month, $year, $answersToBeCountedArray, $additoinalQueryString = '') {
    //$month = str_pad($month, 2, '0', STR_PAD_LEFT);
    if(strlen($month)<2){
        $month="0".$month;
    }
    $question_count = getQuestionCountTar();

    if (strlen($org_code) && orgCodeValid($org_code) && strlen($month) && strlen($year)) {
        $sql = "SELECT * FROM hss_tertiary_answer_storage WHERE answer_storage_org_id='$org_code' AND answer_storage_month_year='$month-$year' $additoinalQueryString ";
        $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
        $a = mysql_fetch_rowsarr($r); // stores result in array
        //myprint_r($a); 
        $ans_count = 0;
        foreach ($a as $ans) {
            for ($i = 1; $i <= $question_count; $i++) {
                if (in_array($ans["answer_storage_q" . $i . "_answer"], $answersToBeCountedArray)) {
                    if (questionNoBelongsToOrgTar($i, $org_code)) {
                        //echo "answer_storage_q" . $i . "_answer = Yes <br/>"; // debug
                        $ans_count++;
                    }
                }
            }
        }
        return $ans_count;
    }
    return false;
}

function questionNoBelongsToOrg($i, $org_code) {
    $question_type_id = getQuestionTypeId($i);
    //echo "question_type_id = $question_type_id<br/>"; // debug
    $question_type_name = getQuestionTypeNameFrmId($question_type_id);
    //echo "question_type_name = $question_type_name<br/>"; // debug
    $org_district_name = getOrgDistrictName($org_code);
    //echo "org_district_name = $org_district_name<br/>"; // debug
    if (getRows('hss_question_type_div_district', " WHERE type_name='$question_type_name' && district_name LIKE \"%$org_district_name%\" ")) {
        return true;
    }
    return false;
}


function questionNoBelongsToOrgTar($i, $org_code) {
    $question_type_id = getQuestionTypeIdTar($i);
    //echo "question_type_id = $question_type_id<br/>"; // debug
    $question_type_name = getQuestionTypeNameFrmIdTar($question_type_id);
    //echo "question_type_name = $question_type_name<br/>"; // debug
    $org_district_name = getOrgDistrictName($org_code);
    //echo "org_district_name = $org_district_name<br/>"; // debug
    if (getRows('hss_question_type_div_district_tertiary', " WHERE type_name='$question_type_name' && district_name LIKE \"%$org_district_name%\" ")) {
        return true;
    }
    return false;
}


function questionTypeBelongsToOrg($question_type_id, $org_code) {
   
    $question_type_name = getQuestionTypeNameFrmId($question_type_id);
    //echo "question_type_name = $question_type_name<br/>"; // debug
    $org_district_name = getOrgDistrictName($org_code);
    //echo "org_district_name = $org_district_name<br/>"; // debug
    if (getRows('hss_question_type_div_district', " WHERE type_name='$question_type_name' && district_name LIKE \"%$org_district_name%\" ")) {
        return true;
    }
    return false;
}

function questionTypeBelongsToOrgTar($question_type_id, $org_code) {
   
    $question_type_name = getQuestionTypeNameFrmIdTar($question_type_id);
    //echo "question_type_name = $question_type_name<br/>"; // debug
    $org_district_name = getOrgDistrictName($org_code);
    //echo "org_district_name = $org_district_name<br/>"; // debug
    if ($a=getRows('hss_question_type_div_district_tertiary', " WHERE type_name='$question_type_name' && district_name LIKE \"%$org_district_name%\" ")) {
      //myprint_r($a);
      return true;
    }
    return false;
}

function countOfQuestoinsAssignedToOrg($org_code) {
    $question_count = getQuestionCount();
    $count = 0;
    for ($i = 1; $i <= $question_count; $i++) {
        if (questionNoBelongsToOrg($i, $org_code)) {
            //echo "answer_storage_q" . $i . "_answer = Yes <br/>";
            $count++;
        }
    }
    return $count;
}

function countOfQuestoinsAssignedToOrgTar($org_code) {
    $question_count = getQuestionCountTar();
    $count = 0;
    for ($i = 1; $i <= $question_count; $i++) {
        if (questionNoBelongsToOrgTar($i, $org_code)) {
            //echo "answer_storage_q" . $i . "_answer = Yes <br/>";
            $count++;
        }
    }
    return $count;
}

function getQuestionTypeId($question_id) {
    return getRowFieldVal('hss_questions', 'question_type_id', 'question_id', $question_id);
}

function getQuestionTypeIdTar($question_id) {
    return getRowFieldVal('hss_tertiary_question', 'question_type_id', 'question_id', $question_id);
}

function getQuestionTypeNameFrmId($question_type_id) {
    return getRowFieldVal('hss_question_type', 'type_name', 'type_id', $question_type_id);
}
function getQuestionTypeNameFrmIdTar($question_type_id) {
    return getRowFieldVal('hss_tertiary_question_type', 'type_name', 'type_id', $question_type_id);
}

function getOrgDistrictName($org_code) {
    return getRowFieldVal('organization', 'district_name', 'org_code', $org_code);
}

function getQuestionCount() {
    $sql = "SELECT count(*) as total FROM hss_questions ";
    $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
    $a = mysql_fetch_assoc($r); // stores result in array
    return $a['total'];
}

function getQuestionCountTar() {
    $sql = "SELECT count(*) as total FROM hss_tertiary_question";
    $r = mysql_query($sql) or die(mysql_error() . "<pre>Query: $sql</pre>");
    $a = mysql_fetch_assoc($r); // stores result in array
    return $a['total'];
}
function orgCodeValid($org_code) {
    return getRowVal('organization', 'org_code', $org_code); // returns false if there is no result of the query
}

function getDivisions() {
    return getRows('admin_division');
}

function getDistricts(){
    return getRows('admin_district');
}
function getDistrictsUnderDivision($division_bbs_code){
    return getRows('admin_district'," WHERE division_bbs_code='$division_bbs_code'");
}

function getUpazilasUnderDistrict($district_bbs_code){
    return getRows('admin_upazila'," WHERE upazila_district_code='$district_bbs_code'");
}

$org_type_code_csv="'1022','1023','1028','1029'";
$exceptoin_org_code_csv="'10001109','10001972','10000753','10000864','10013720','10002304','10000105','10001805','10000393','10001214','10000575','10002196'";  // org_codes that needs to be escaped 

$tartiary_org_codes_array="'10001811','10000425','10001109'";  
$tartiary_type_codes_array="'1002','1005'";
$tartiary_exception_org_codes_array="'10002303'";


function getAllOrgUnderDivisionTar($division_code) {
    global $tartiary_org_codes_array;
    global $tartiary_type_codes_array;
    global $tartiary_exception_org_codes_array;
    return getRows('organization', " WHERE division_code='$division_code' AND org_type_code IN($tartiary_type_codes_array) OR (division_code='$division_code' AND org_code IN($tartiary_org_codes_array))");
}

function getAllOrgUnderDivision($division_code) {
    global $org_type_code_csv;
    global $exceptoin_org_code_csv;
    return getRows('organization', " WHERE division_code='$division_code' AND org_type_code IN($org_type_code_csv) AND org_code NOT IN($exceptoin_org_code_csv)");
}

function getAllOrgUnderDistrict($district_bbs_code) {
    global $org_type_code_csv;
    global $exceptoin_org_code_csv;
    return getRows('organization', " WHERE district_code='$district_bbs_code' AND org_type_code IN($org_type_code_csv) AND org_code NOT IN($exceptoin_org_code_csv)");
}

function getAllOrgUnderUpazila($district_bbs_code,$upazila_thana_code) {
    global $org_type_code_csv;
    global $exceptoin_org_code_csv;
    return getRows('organization', " WHERE district_code='$district_bbs_code' AND upazila_thana_code='$upazila_thana_code' AND org_type_code IN($org_type_code_csv) AND org_code NOT IN($exceptoin_org_code_csv)");
}

function checkIfOrgIsTartiary($org_code){
  if(orgCodeValid($org_code)){
  $org=  getRowVal('organization', 'org_code', $org_code);
 // myprint_r($org);
  
  $tartiary_org_codes_array=array('10001811','10000425','10001109');  
  $tartiary_type_codes_array=array('1002','1005');
  
  if(in_array($org['org_code'], $tartiary_org_codes_array)){
    return true;
  }
  if(in_array($org['org_type_code'], $tartiary_type_codes_array)){
    return true;
  }
  
  return false;
  }
}
?>