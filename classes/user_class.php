<?php
require_once("../settings/db_class.php");

class Users extends db_connection
{

    // add a user to the database
    function registerUser($user_name, $user_email, $user_school_id,$phone_number, $password)
    {
        $sql = "INSERT INTO `user`(`user_name`, `user_email`, `user_school_id`, `phone_number`, `password`) VALUES ('$user_name',' $user_email','$user_school_id',,'$phone_number',' $password')";

        return $this->db_query($sql);
    }
    // voting for a candidate under an award
    function vote($user_id,$nomimee_id,$award_id )
    {
        $sql = "INSERT INTO `vote`(`user_id`, `nominee_id`, `award_id`) VALUES ('$user_id','$nomimee_id','$award_id')";

        return $this->db_query($sql);
    }

    // selects All users in the database
    function getAllUser(){
        $sql = "SELECT * FROM `user`";

        return $this->fetchAllData($sql);
    }

    //returns a particuler user details  
    function getAUser($user_id){
        $sql = "SELECT `user_name`, `user_email`, `user_school_id`, `phone_number`, `password`, `user_role` FROM `user` WHERE `user_id`= '$user_id'";

        return $this->fetchOne($sql);
    }

    // used to access the userRole of a user
    function getUserRole($user_id){
        $sql = "SELECT `user_role` FROM `user` WHERE `user_id`= '$user_id'";

        return $this->db_query($sql);
    }


    // if login is true, it should return only 1 data from the database
    function login($user_email, $password){
        $sql = "SELECT * FROM `user` WHERE `user_email`= '$user_email' and  `password` ='$password'";

        return $this->fetchOne($sql);
    }

    // checjing if email exist
    function checkEmail($user_email){
        $sql = "SELECT * FROM `user` WHERE `user_email`= '$user_email'";
        $this->fetchAllData($sql);
        return $this->countData();
    }    

    // checks if the user role is 0. if not then the person is not an admin
    function checkUserPrivilege($user_id){
        $role = $this->getUserRole($user_id);

        return $role === 0;
    }  
    
    function updateUser($user_id,$user_name, $user_email, $user_school_id, $password, $phone_number){
        $sql = "UPDATE `user` SET `user_name`='$user_name',`user_email`='$user_email',`user_school_id`='$user_school_id',`password`='$password',`phone_number`=' $phone_number' WHERE `user_id` ='$user_id' ";

        return $this->db_query($sql);
    }
    
}
