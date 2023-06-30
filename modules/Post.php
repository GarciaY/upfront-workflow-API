<?php 
	class Post {
		protected $pdo, $gm, $get;

		public function __construct(\PDO $pdo) {
			$this->gm = new GlobalMethods($pdo);
			$this->get = new Get($pdo);
			$this->pdo = $pdo;
		}

		public function add_voucher ($data)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to save data";
			
			try{
				
				$check_voucher_id = "SELECT * FROM voucher_tbl WHERE user_id = ?";
				$check_voucher_id = $this->pdo->prepare($check_voucher_id);
                $check_voucher_id->execute([	
                   $data->user_id
                ]);
				
				$count = $check_voucher_id->rowCount();

				if ($count > 0) {
					$payload = ["voucher_id" => 0 ];
					$code = 200;
					$remarks = "success";
					$message = "Voucher No. Already exist.";

						
					}else{
						
						$sql = "INSERT INTO voucher_tbl (user_id,date,payee ,address,SoF,type,status) VALUES (?,?,?,?,?,?,?)";
						$sql = $this->pdo->prepare($sql);
						$sql->execute([ $data->user_id,$data->date,$data->payee,$data->address,$data->SoF,$data->type,$data->status]);

						$LAST_ID = $this->pdo->lastInsertId();
						
						$particular = "INSERT INTO particular_tbl (v_id,comment1,comment2,comment3,ammount_due) VALUES (?,?,?,?,?)";
						$particular = $this->pdo->prepare($particular);
						$particular->execute([ $LAST_ID,$data->comment1,$data->comment2,$data->comment3,$data->ammount_due]);
					
						$payment = "INSERT INTO payment_tbl (v_id,Type_of_payment) VALUES (?,?)";
						$payment = $this->pdo->prepare($payment);
						$payment->execute([ $LAST_ID,$data->Type_of_payment]);
					
						$signature = "INSERT INTO signature_tbl (v_id,approved_by,received_by) VALUES (?,?,?)";
						$signature = $this->pdo->prepare($signature);
						$signature->execute([ $LAST_ID,$data->approved_by,$data->received_by]);

				
						$payload = ["voucher_id"=>$LAST_ID];
						$code = 200;
						$remarks = "success";
						$message = "Successfully inserted data";
						
						return $this->gm->response($payload, $remarks, $message, $code);
					}

					return $this->gm->response($payload, $remarks, $message, $code);
	
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}

			 
		}

		public function add_loan($data)
		{
			
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to save data";

			try{
											
				$sql = "INSERT INTO personaldata_tbl (user_id,Firstname,Lastname,PassbookNo,Address ,Department , MobileNo, personalMembership) VALUES (?,?,?,?,?,?,?,?)";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([ $data->user_id,$data->Firstname,$data->Lastname,$data->PassbookNo,$data->Address, $data->Department, $data->MobileNo,$data->personalMembership]);
			

				$LAST_ID = $this->pdo->lastInsertId();

				$this->loanInfo($LAST_ID,$data->transactionType,$data->loanAmountFigure,$data->loanAmountWords,$data->loanType,$data->loanTerm,$data->paymentFrequency); 


				$code = 200;
				$remarks = "success";
				$message = "Successfully inserted data";
				

				return $this->gm->response($payload, $remarks, $message, $code);
				
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function accountinEntry($data) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to save data";
			try{
				
				$sql = "INSERT INTO acountingentry_tbl (v_id,acc_code,acc_title,debit,credit) VALUES (?,?,?,?,?)";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([ (int)$data->v_id,$data->acc_code,$data->acc_title,$data->debit,$data->credit]);
				
				$code = 200;
				$remarks = "success";
				$message = "Successfully inserted data";
				

				return $this->gm->response($payload, $remarks, $message, $code);
				
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}
		private function loanInfo($personal_id,$transactionType,$loanAmountFigure,$loanAmountWords,$loanType,$loanTerm,$paymentFrequency) 
		{							
			$sql = "INSERT INTO loaninformation_tbl (personal_id,transactionType,loanAmountFigure,loanAmountWords,loanType,loanTerm ,paymentFrequency) VALUES (?,?,?,?,?,?,?)";
			$sql = $this->pdo->prepare($sql);
			$sql->execute([ $personal_id,$transactionType,$loanAmountFigure,$loanAmountWords,$loanType,$loanTerm,$paymentFrequency]);
		}
		private function particular($v_id,$comment1,$comment2,$comment3,$ammount_due) 
		{					
			$particular = "INSERT INTO particular_tbl (v_id,comment1,comment2,comment3,ammount_due) VALUES (?,?,?,?,?)";
			$particular = $this->pdo->prepare($particular);
			$particular->execute([ $v_id,$comment1,$comment2,$comment3,$ammount_due]);
		
		}
		private function payment($v_id,$Type_of_payment) 
		{
			$payment = "INSERT INTO payment_tbl (v_id,Type_of_payment) VALUES (?,?)";
			$payment = $this->pdo->prepare($payment);
			$payment->execute([ $v_id,$Type_of_payment]);
		
		}
		
		private function signature($v_id,$approved_by,$received_by) 
		{
			$signature = "INSERT INTO signature_tbl (v_id,approved_by,received_by) VALUES (?,?,?)";
			$signature = $this->pdo->prepare($signature);
			$signature->execute([ $v_id,$approved_by,$received_by]);
		}

		public function update_loan_approved($id) 
		{

			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to update data";
			$status = "Approved";
			try{
				$this->pdo->beginTransaction();

				$sql = "UPDATE loaninformation_tbl SET loan_status = ? WHERE personal_id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([ $status ,$id]);
				$this->pdo->commit();

				$code = 200;
				$remarks = "success";
				$message = "Successfully updated requested records";
				
				
				$sql2 = "SELECT * FROM personaldata_tbl WHERE personal_id = ? LIMIT 1";
				$sql2 = $this->pdo->prepare($sql2);
				$sql2->execute([	
					$id
				]);

				$res = $sql2->fetch(PDO::FETCH_ASSOC);

				$user_id = $res["user_id"];
				
				$title = "Approved";
				$content = "Your loan has been approved.";

				$sql3 = "INSERT INTO notif (user_id,personal_id,title,content) VALUES (?,?,?,?)";
				$sql3 = $this->pdo->prepare($sql3);
				$sql3->execute([$user_id, $id ,$title,$content]);


				return $this->gm->response($payload, $remarks, $message, $code);
					
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function update_loan_release($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to update data";
			$status = "Release";
			try{
				$this->pdo->beginTransaction();

				$sql = "UPDATE loaninformation_tbl SET loan_status = ? WHERE personal_id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([ $status ,$id]);
				$this->pdo->commit();

				$code = 200;
				$remarks = "success";
				$message = "Successfully updated requested records";
				
				
				$sql2 = "SELECT * FROM personaldata_tbl WHERE personal_id = ? LIMIT 1";
				$sql2 = $this->pdo->prepare($sql2);
				$sql2->execute([	
					$id
				]);

				$res = $sql2->fetch(PDO::FETCH_ASSOC);

				$user_id = $res["user_id"];
				
				$title = "Release";
				$content = "Your loan has been released.";

				$sql3 = "INSERT INTO notif (user_id,personal_id,title,content) VALUES (?,?,?,?)";
				$sql3 = $this->pdo->prepare($sql3);
				$sql3->execute([$user_id,$id,$title,$content]);


				return $this->gm->response($payload, $remarks, $message, $code);
					
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function update_loan_notify($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to update data";
			$status = "Approved";
			try{
				// $this->pdo->beginTransaction();

				// $sql = "UPDATE loaninformation_tbl SET loan_status = ? WHERE personal_id = ?";
				// $sql = $this->pdo->prepare($sql);
				// $sql->execute([ $status ,$id]);
				// $this->pdo->commit();

				
			
				$sql2 = "SELECT * FROM personaldata_tbl WHERE personal_id = ? LIMIT 1";
				$sql2 = $this->pdo->prepare($sql2);
				$sql2->execute([	
					$id
				]);
				
				$res = $sql2->fetch(PDO::FETCH_ASSOC);

				$user_id = $res["user_id"];
				
				$title = "Attention";
				$content = "Please check your next due of payment on your loan account.";

				$sql3 = "INSERT INTO notif (user_id,personal_id,title,content) VALUES (?,?,?,?)";
				$sql3 = $this->pdo->prepare($sql3);
				$sql3->execute([$user_id, $id, $title,$content]);

				$code = 200;
				$remarks = "success";
				$message = "Successfully updated notify records";
				return $this->gm->response($payload, $remarks, $message, $code);
					
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}


		public function update_loan_disapproved($id) 
		{

			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to update data";
			$status = "Disapproved";
			try{
				$this->pdo->beginTransaction();

				$sql = "UPDATE loaninformation_tbl SET loan_status = ? WHERE personal_id = ?";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([ $status ,$id]);
				$this->pdo->commit();

				$code = 200;
				$remarks = "success";
				$message = "Successfully updated requested records";
				
				
				$sql2 = "SELECT * FROM personaldata_tbl WHERE personal_id = ? LIMIT 1";
				$sql2 = $this->pdo->prepare($sql2);
				$sql2->execute([	
					$id
				]);

				$res = $sql2->fetch(PDO::FETCH_ASSOC);

				$user_id = $res["user_id"];
				
				$title = "Disapproved";
				$content = "Your request has been dissapproved, please contact the office for more information. Check Loan Policy";

				$sql3 = "INSERT INTO notif (user_id,personal_id,title,content) VALUES (?,?,?,?)";
				$sql3 = $this->pdo->prepare($sql3);
				$sql3->execute([$user_id, $id, $title,$content]);


				return $this->gm->response($payload, $remarks, $message, $code);
					
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function input_Reason($id,$reason)
		{
			
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to insert data";
			

			try {
				$this->pdo->beginTransaction();
				$replacedString = str_replace("_", " ", $reason);
				
				
				$sql = "INSERT INTO reasoning_tbl (relational_id, reason) VALUES ( ?,?)";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute([ (int)$id, $replacedString]);

				$sql2 = "SELECT * FROM personaldata_tbl WHERE personal_id = ? LIMIT 1 ";
				$sql2 = $this->pdo->prepare($sql2);
                $sql2->execute([	
                    (int)$id
                ]);
				$res = $sql2->fetch(PDO::FETCH_ASSOC);
				

				$sql3 = "INSERT INTO notif (user_id,personal_id,title, content) VALUES (?,?,?,?)";
				$sql3 = $this->pdo->prepare($sql3);
				$sql3->execute([$res["user_id"],$res["personal_id"],"Disapproved",$replacedString]);
				
				$this->pdo->commit();

				$code = 200;
				$remarks = "success";
				$message = "Successfully inserted data";

				return $this->gm->response($payload, $remarks, $message, $code);
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

	

		public function create_notif($data)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "INSERT INTO notif (user_id,content) VALUES (?,?)";
				$sql = $this->pdo->prepare($sql);
				$sql->execute([$data->user_id,$data->content]);

				$code = 200;
				$remarks = "success";
				$message = "Successfully retrieved requested records";

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		// update
		public function read_notif($id) 
		{

			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to update data";

			try{

				$sql = "SELECT * FROM notif WHERE user_id = ? AND status = 'unread' ";
				$sql = $this->pdo->prepare($sql);
                $sql->execute([	
                    $id
                ]);
               
                $count = $sql->rowCount();


                for ($i=0; $i < $count; $i++) { 
					
					
					$this->pdo->beginTransaction();
				
					$updateUser_SQL = "UPDATE notif SET status = 'read' WHERE user_id = ?";
					$updateUser_SQL = $this->pdo->prepare($updateUser_SQL);
					$updateUser_SQL->execute([ $id ]);
					$this->pdo->commit();
				}


				$code = 200;
				$remarks = "success";
				$message = "Successfully updated requested records";
			
				return $this->gm->response($payload, $remarks, $message, $code);
					
			} catch (\PDOException $e) {
				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function deleteVoucher($id)
		{
			$payload = [];
				$code = 404;
				$remarks = "failed";
				$message = "Unable to retrieve data";

				try {
					
					$voucher_tbl = "DELETE FROM voucher_tbl WHERE voucher_id = ?";
					$voucher_tbl = $this->pdo->prepare($voucher_tbl);
					$voucher_tbl->execute([$id]);

					$signature_tbl = "DELETE FROM signature_tbl WHERE v_id = ?";
					$signature_tbl = $this->pdo->prepare($signature_tbl);
					$signature_tbl->execute([$id]);

					$payment_tbl = "DELETE FROM payment_tbl WHERE v_id = ?";
					$payment_tbl = $this->pdo->prepare($payment_tbl);
					$payment_tbl->execute([$id]);

					$particular_tbl = "DELETE FROM particular_tbl WHERE v_id = ?";
					$particular_tbl = $this->pdo->prepare($particular_tbl);
					$particular_tbl->execute([$id]);

			
					$acountingentry_tbl = "DELETE FROM acountingentry_tbl WHERE v_id = ?";
					$acountingentry_tbl = $this->pdo->prepare($acountingentry_tbl);
					$acountingentry_tbl->execute([$id]);

					

					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

					return $this->gm->response($payload, $remarks, $message, $code);

				} catch (\PDOException $e) {

					return $this->gm->response($payload, $remarks, $message, $code);
				}
		}
		public function deleteLoan($id)
		{
				$payload = [];
					$code = 404;
					$remarks = "failed";
					$message = "Unable to retrieve data";
	
					try {
						
						$loaninformation_tbl = "DELETE FROM loaninformation_tbl WHERE personal_id = ?";
						$loaninformation_tbl = $this->pdo->prepare($loaninformation_tbl);
						$loaninformation_tbl->execute([$id]);
	
						$personaldata_tbl = "DELETE FROM personaldata_tbl WHERE personal_id = ?";
						$personaldata_tbl = $this->pdo->prepare($personaldata_tbl);
						$personaldata_tbl->execute([$id]);
	
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
	
						return $this->gm->response($payload, $remarks, $message, $code);
	
					} catch (\PDOException $e) {
	
						return $this->gm->response($payload, $remarks, $message, $code);
					}
		}
	
}
?>