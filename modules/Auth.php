<?php

class Auth
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->gm = new GlobalMethods($pdo);
        $this->get = new Get($pdo);
        $this->pdo = $pdo;
    }

    public function admin_login($data)
    {
        $payload = [
            "username" => "Not found",
            "id" => 0,
            "name" => "Not found"
        ];
        $code = 404;
        $remarks = "failed";
        $message = "Wrong Password";

        try{
                $sql = "SELECT * FROM adminacc_tbl WHERE admin_email = ? LIMIT 1";
                $sql = $this->pdo->prepare($sql);
                $sql->execute([	
                    $data->username
                ]);

                $count = $sql->rowCount();
               
                if ($count > 0) {

                    $res = $sql->fetch(PDO::FETCH_ASSOC);
                
                    $username = $res["admin_email"];
                    $id = $res["admin_id"];
                    $name = $res["admin_name"];

                
                    if (password_verify($data->password, $res['admin_password'])) {
                            $payload = [
                                "username" => $username,
                                "id" => $id,
                                "name" => $name
                            ];
                            $code = 200;
                            $remarks = "success";
                            $message = "Login success.";
                            return $this->gm->response($payload, $remarks, $message, $code);
                        }
                   
                    return $this->gm->response($payload, $remarks, $message, $code);
                }else{
                    $message = "Incorrect username";
                    return $this->gm->response($payload, $remarks, $message, $code);
                } 
               
                
            } catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
    }
    
    public function admin_Register($data)
    {
        $payload = [];
        $code = 404;
        $remarks = "failed";
        $message = "No Record found";

        try{
                $sql = "SELECT * FROM adminacc_tbl WHERE admin_email = ? LIMIT 1";
                $sql = $this->pdo->prepare($sql);
                $sql->execute([	
                    $data->email
                ]);

               
                $count = $sql->rowCount();
               
                if ($count > 0) {
                    $message = 'Username already exist';
                    return $this->gm->response($payload, $remarks, $message, $code);

                } else {
                    
                    $sql = "INSERT INTO adminacc_tbl (admin_name,admin_email,admin_password) VALUES (?,?,?)";
                    $sql = $this->pdo->prepare($sql);
                    $sql->execute([	
                        $data->name,
                        $data->email,
                         password_hash($data->password, PASSWORD_DEFAULT)
                    ]);
                    $code = 200;
                    $remarks = "success";
                    $message = "Successfully inserted data";

                    return $this->gm->response($payload, $remarks, $message, $code);
                }

                
            } catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
    }



    public function user_login($data)
    {
        $payload = [];
        $code = 404;
        $remarks = "failed";
        $message = "No Record found";
        try {
           
            $sql = "SELECT * FROM user_tbl WHERE passbook_no = ? LIMIT 1";
            $sql = $this->pdo->prepare($sql);
            $sql->execute([$data->username]);
            
            $res = $sql->fetch(PDO::FETCH_ASSOC);
            
            $username = $res["passbook_no"];
            $id = $res["id"];
            $firstname = $res["first_name"];
            $lastname = $res["last_name"];
            $hashedPassword = $res['password'];
    
            if (password_verify($data->password, $hashedPassword)) {
                $payload = [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "username" => $username,
                    "id" => $id
                ];
                
                $code = 200;
                $remarks = "success";
                $message = "Login success.";
                return $this->gm->response($payload, $remarks, $message, $code);
            }
    
            $code = 404;
            $remarks = "failed";
            $message = "No Record found";
            return $this->gm->response($payload, $remarks, $message, $code);
    
        } catch (\PDOException $e) {
            return $this->gm->response($payload, $remarks, $message, $code);
        }
    }
    
    public function hash_pass()
    {
       
        $payload = [];
        $code = 404;
        $remarks = "failed";
        $message = "No Record found";

       try{
            
        $sql = "SELECT * FROM user_tbl";

        $res = $this->gm->executeQuery($sql);

        foreach ($res['data'] as $value) 
        {
         
            $this->pdo->beginTransaction();

            $sql = "UPDATE user_tbl SET password = ? WHERE id = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute([password_hash($value['password'], PASSWORD_DEFAULT) ,$value['id']]);
            $this->pdo->commit();

        }
         
        $code = 200;
        $remarks = "success";
        $message = "Successfully updated requested records";

        } catch(\PDOException $e){

        }
    }

    // public function user_signup($data)
    // {
    //     $payload = [];
    //     $code = 404;
    //     $remarks = "failed";
    //     $message = "No Record found";

    //     try{
    //             $sql = "SELECT * FROM user_tbl WHERE email = ? LIMIT 1";
    //             $sql = $this->pdo->prepare($sql);
    //             $sql->execute([	
    //                 $data->e
    //             ]);

               
    //             $count = $sql->rowCount();
               
    //             if ($count > 0) {
    //                 $message = 'passbook_no already registered';
    //                 return $this->gm->response($payload, $remarks, $message, $code);

    //             } else {
                    

    //                 $sql = "INSERT INTO user_tbl (firstname,lastname,email,password) VALUES (?,?,?,?)";
    //                 $sql = $this->pdo->prepare($sql);
    //                 $sql->execute([
    //                     $data->firstname,
    //                     $data->lastname,	
    //                     $data->passbook_no, 
    //                      password_hash($data->password, PASSWORD_DEFAULT)
    //                 ]);
    //                 $code = 200;
    //                 $remarks = "success";
    //                 $message = "Successfully inserted data";

    //                 return $this->gm->response($payload, $remarks, $message, $code);
    //             }

                
    //         } catch (\PDOException $e) {
	// 			return $this->gm->response($payload, $remarks, $message, $code);
	// 		}
    // }

    public function changePass($data,$id){
        $payload = [];
        $code = 404;
        $remarks = "failed";
        $message = "No Record found";

        try{
            $sql = "SELECT * FROM adminacc_tbl WHERE admin_id = ? LIMIT 1";
            $sql = $this->pdo->prepare($sql);
            $sql->execute([	
                $id
            ]);
            $res = $sql->fetch(PDO::FETCH_ASSOC);

            $admin_name = $res["admin_name"];
            $admin_id = $res["admin_id"];
            $admin_email = $res["admin_email"];

            $count = $sql->rowCount();
           
            if ($count > 0) {
                 if (password_verify($data->curren_password, $res['admin_password'])) 
                 {
                        $this->pdo->beginTransaction();

                        $updateUser_SQL = "UPDATE adminacc_tbl SET admin_password = ? WHERE admin_id = ?";
                        $updateUser_SQL = $this->pdo->prepare($updateUser_SQL);
                        $updateUser_SQL->execute([ password_hash($data->password, PASSWORD_DEFAULT), $id]);
                        $this->pdo->commit();

                       
                        $code = 200;
                        $remarks = "success";
                        $message = "Successfully updated requested records";
                    
                        return $this->gm->response($payload, $remarks, $message, $code);
                 }else{
                       
                        $message = "Current Password Didn't Match.";
                        return $this->gm->response($payload, $remarks, $message, $code);
                    
                 }
            }
                
            } catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
    }

}