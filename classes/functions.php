<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "database.php";

function check_login()
{
    if (isset($_SESSION['userid']))
        return true;
    else
        return false;
}
function check_admin()
{
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
        return true;
    else
        return false;
}
function check_first_time()
{
    $DB = new Database();
    $sql = "SELECT * FROM admin LIMIT 1";
    if($DB->read($sql))
        return false;
    else
        return true;
}

function signup($data)
{
    $DB = new Database();
    $email = $data['email'];
    $sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    if($DB->read($sql))
        return false;

    $password = hash('sha1', $data['password']);
    $admin_id = create_id();

    $sql = "INSERT INTO admin (admin_id,email,password) VALUES ('$admin_id','$email','$password')";
    if($DB->save($sql))
        return true;
    return false;
}

function admin_login($data)
{
    $DB = new Database();
    $email = $data['email'];
    $password = hash('sha1',$data['password']);

    $sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    $result = $DB->read($sql);
    if($result)
    {
        $result = $result[0];
        if($result['password'] != $password)
            return false;
        else{
            $_SESSION['admin'] = true;
            $_SESSION['userid'] = $result['admin_id'];
            return true;
        }
    }
    return false;
}

function std_login($data)
{
    $DB = new Database();
    $email = $data['email'];
    $password = hash('sha1',$data['password']);

    $sql = "SELECT * FROM students WHERE email='$email' LIMIT 1";
    $result = $DB->read($sql);
    if($result)
    {
        $result = $result[0];
        if($result['pass'] != $password)
            return false;
        else{
            $_SESSION['admin'] = false;
            $_SESSION['userid'] = $result['roll'];
            return true;
        }
    }
    return false; 
}

function add_new_student($data,$file)
{
    $DB = new Database();
    $roll = $data['roll'];
    $sql = "SELECT * FROM students WHERE roll='$roll' LIMIT 1";
    if($DB->read($sql))
        return 'r';

    $email = $data['email'];
    $sql = "SELECT * FROM students WHERE email='$email' LIMIT 1";
    if($DB->read($sql))
        return 'e';


    $fullname = strtolower($data['name']);
    $fullname = explode(" ",$fullname);
    $fname = ucfirst($fullname[0]);
    $lname = ucfirst($fullname[1]);

    $grade = $data['grade'];
    $faculty = $data['faculty'];
    $gender = $data['gender'];
    $dob = $data['dob'];

    $contact = $data['contact'];
    $address = ucfirst(strtolower($data['address']));

    $fullname = strtolower($data['pname']);
    $fullname = explode(" ",$fullname);
    $p_fname = ucfirst($fullname[0]);
    $p_lname = ucfirst($fullname[1]);

    $p_contact = $data['pcontact'];
    $room = $data['room'];

    $password = hash('sha1', $data['password']);
    $s_id = create_id();

    $folder = "students/";

    if(!file_exists("../".$folder))
    {
        mkdir("../".$folder,0777, true);
        $info = "<?php  ?>";
        file_put_contents("../".$folder."index.php", $info);
    }
    $filename = false;
    if($file['type'] == "image/png")
    {
        $filename = $folder.$roll.".png";
    }else{
        $filename = $folder.$roll.".jpg";
    }
    if($filename)
    {
        move_uploaded_file($file['tmp_name'],"../".$filename);
    }else
        return false;
    
    $sql = "INSERT INTO students (`roll`,`fname`,`lname`,`gender`,`dob`,`contact`,`address`,`photo`,`email`,`pass`,`grade`,`faculty`,`p_fname`,`p_lname`,`p_contact`,`room`) VALUES ('$roll','$fname','$lname', '$gender', '$dob', '$contact', '$address','$filename','$email','$password','$grade','$faculty','$p_fname','$p_lname','$p_contact','$room')";
    if($DB->save($sql))
        return 'success';
    return false;

}

function submit_complain($data)
{
    $DB = new Database();
    $roll = $_SESSION['userid'];
    $type = $data['type'];
    $text = addslashes(htmlspecialchars($data['text']));
    $sql = "INSERT INTO complains (`roll`,`type`,`text`) VALUES ('$roll','$type','$text')";
    if($DB->save($sql))
        return 'success';
    return false;
}

function get_my_detail()
{
    if(!check_login())
        return false;
    $DB = new Database();
    $roll = $_SESSION['userid'];
    $sql = "SELECT fname,lname,photo FROM students WHERE roll='$roll' LIMIT 1";
    $result = $DB->read($sql);
    if(is_array($result))
        return $result[0];
    return false;
}
function create_id()
{
    $length = rand(4, 6);
    $num = "";
    for ($i = 0; $i < $length; $i++) {
        $rand1 = rand(0, 9);
        if($i == 0 && $rand1 == 0)
            $num = $num . '1';
        $num = $num . $rand1;
    }
    return $num;
}

function get_students()
{
    $DB = new Database();
    $sql = "SELECT * FROM students";
    $result = $DB->read($sql);
    if(is_array($result))
        return $result;
    return false;
}
function get_std_name($roll){
    $DB = new Database();
    $sql = "SELECT fname,lname FROM students WHERE roll='$roll' LIMIT 1";
    $result = $DB->read(query: $sql);
    if(is_array($result))
    {
        $result = $result[0];
        $name = "$result[fname] $result[lname]";
        return $name;
    }
    return false;
}
function get_complains(){
    $DB = new Database();
    $sql = "SELECT * FROM complains";
    $result = $DB->read($sql);
    if(is_array($result))
        return $result;
    return false;
}
function get_student($roll){
    $DB = new Database();
    $sql = "SELECT * FROM students WHERE roll='$roll' LIMIT 1";
    $result = $DB->read($sql);
    if(is_array($result))
        return $result[0];
    return false;
}

function edit_student($roll, $data)
{
    $DB = new Database();
    $grade = $data['grade'];
    $faculty = $data['faculty'];

    $contact = $data['contact'];
    $address = ucfirst(strtolower($data['address']));

    $p_contact = $data['pcontact'];
    $room = $data['room'];
    $sql = "UPDATE students SET grade='$grade',faculty='$faculty',contact='$contact',address='$address',p_contact='$p_contact',room='$room' WHERE roll='$roll' LIMIT 1";
    if($DB->save($sql))
        return 'success';
    return false;
}
?>
