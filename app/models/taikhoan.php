<?php
    function insert_taikhoan($username,$email,$password,$tel,$address){
        $sql="INSERT INTO taikhoan(username,password,email,tel,address) values('$username','$email','$password','$tel','$address')";
        pdo_execute($sql);
    }
    function delete_taikhoan($id){
        $sql="delete from taikhoan where id_user=".$id;
        pdo_execute($sql);
    }
    function loadone_taikhoan($id){
        $sql="select * from taikhoan where id_user=".$id;
        $tk=pdo_query_one($sql);
        return $tk;
    }
    function checkUser($user, $pass){
        $sql = "select * from taikhoan where username ='".$user."' AND password = '".$pass."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function checkEmail($email){
        $sql = "select * from taikhoan where email = '".$email."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function update_taikhoan($id,$user,$password,$email,$address,$tel){
        $sql="UPDATE taikhoan
            SET username = '$user', password = '$password',email = '$email',tel = '$tel',address = '$address'
            WHERE id_user=$id";
        pdo_execute($sql);
    }
    function loadall_taikhoan($kyw){
        $sql="SELECT * FROM taikhoan where 1";
        if($kyw!=""){
            $sql.=" and username like '%".$kyw."%'";
        }
        $sql.=" order by id_user desc";
        $listtaikhoan=pdo_query($sql);
        return $listtaikhoan;
    }
    // Function to count total accounts based on the search keyword
    function count_all_taikhoan() {
        // Construct the SQL query to count total accounts
        $sql = "SELECT COUNT(*) AS total FROM taikhoan";
        // Prepare the query
        $pdo = new PDO("mysql:host=localhost;dbname=khachsan", "root", "");
    
        $stmt = $pdo->prepare($sql);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the total count
        $totalCount = $stmt->fetchColumn();
        
        // Return the total count of accounts
        return $totalCount;
    }
    
    // Function to load accounts for the current page
    function load_accounts_for_page($startFrom, $accountsPerPage) {
        // Construct the SQL query to load accounts for the current page
        $sql = "SELECT * FROM taikhoan";
    
        // Add LIMIT and OFFSET clauses for pagination
        $sql .= " LIMIT $startFrom, $accountsPerPage";
    
        // Execute the query and fetch the list of accounts
        $listtaikhoan = pdo_query($sql);
    
        // Return the list of accounts
        return $listtaikhoan;
    }
?>