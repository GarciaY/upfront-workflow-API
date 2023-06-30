<?php
	class Get {
		protected $pdo, $gm;

		public function __construct(\PDO $pdo) {
			$this->gm = new GlobalMethods($pdo);
			$this->pdo = $pdo;
		}

		public function analytic(){
			
		}
		public function get_Loan($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id";
				if ($id != null) {
					$sql.=" WHERE personaldata_tbl.user_id = $id  AND loaninformation_tbl.loan_status != 'Disapproved' ORDER BY loan_id desc";
				}
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";

					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function get_voucher()
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM  particular_tbl 	
											INNER JOIN payment_tbl 			ON particular_tbl.v_id = payment_tbl.v_id
											INNER JOIN signature_tbl 		ON payment_tbl.v_id = signature_tbl.v_id
											INNER JOIN voucher_tbl 			ON voucher_tbl.voucher_id = signature_tbl.v_id
											";
				if ($id != null) {
					$sql.=" WHERE voucher_tbl.user_id = $id";
				}

				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function adminget_voucher()
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM particular_tbl 		
											INNER JOIN payment_tbl 			ON particular_tbl.v_id = payment_tbl.v_id
											INNER JOIN signature_tbl 		ON payment_tbl.v_id = signature_tbl.v_id
											INNER JOIN voucher_tbl 			ON voucher_tbl.voucher_id = signature_tbl.v_id
											";
			

				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}

		public function adminget_Loan() 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl 
								 INNER JOIN loaninformation_tbl 
								 ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
								 WHERE loaninformation_tbl.loan_status = 'Pending'
								 ";
			
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}
		
		public function adminget_allLoan() 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl 
								 INNER JOIN loaninformation_tbl 
								 ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
								 WHERE loaninformation_tbl.loan_status != 'Pending' AND loaninformation_tbl.loan_status != 'Disapproved' AND loaninformation_tbl.loan_status != 'Release'
								 ";
			
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}
		public function adminget_Loan_one($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
						WHERE personaldata_tbl.user_id = $id ";
			
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function adminget_Loan_one_user($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
						WHERE personaldata_tbl.user_id = $id ";
			
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}
		
		public function adminget_Loan_history() 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
						WHERE loaninformation_tbl.loan_status != 'Pending' AND loaninformation_tbl.loan_status != 'Approved' ";
			
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function adminget_Members() 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM user_tbl";
			//;
				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function adminget_MembersHistory($id) 
		{
			
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$reason = "select * FROM reasoning_tbl WHERE user_id  = $id";
				$reasonresult = $this->gm->executeQuery($reason);

				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
						WHERE personaldata_tbl.user_id = $id";
			
				$res = $this->gm->executeQuery($sql);

				foreach ($res["data"] as $data) {

					$arrayData = [];

					if($reasonresult['code'] == 200 && count($reasonresult['data']) > 0){
						

						foreach ($reasonresult['data'] as $reason) {

							if ($reason["relational_id"] == $data['loan_id']) {

								$arrayData['personal_id'] = $data["personal_id"];
								$arrayData['user_id'] = $data["user_id"];
								$arrayData['Firstname'] = $data["Firstname"];
								$arrayData['Lastname'] = $data["Lastname"];
								$arrayData['PassbookNo'] = $data["PassbookNo"];
								$arrayData['Address'] = $data["Address"];
								$arrayData['Department'] = $data["Department"];
								$arrayData['MobileNo'] = $data["MobileNo"];
								$arrayData['personalMembership'] = $data["personalMembership"];
								$arrayData['loan_id'] = $data["loan_id"];
								$arrayData['transactionType'] = $data["transactionType"];
								$arrayData['loanAmountFigure'] = $data["loanAmountFigure"];
								$arrayData['loanAmountWords'] = $data["loanAmountWords"];
								$arrayData['loanType'] = $data["loanType"];
								$arrayData['loanTerm'] = $data["loanTerm"];
								$arrayData['paymentFrequency'] = $data["paymentFrequency"];
								$arrayData['loan_status'] = $data["loan_status"];
								$arrayData['created_at'] = $data["created_at"];
								$arrayData['reason'] = $reason["reason"];
								$arrayData['reason_id'] = $reason["field_id"];
						}

						$isFound = true;
						}
						
					}else{
						
							$arrayData['personal_id'] = $data["personal_id"];
							$arrayData['user_id'] = $data["user_id"];
							$arrayData['Firstname'] = $data["Firstname"];
							$arrayData['Lastname'] = $data["Lastname"];
							$arrayData['PassbookNo'] = $data["PassbookNo"];
							$arrayData['Address'] = $data["Address"];
							$arrayData['Department'] = $data["Department"];
							$arrayData['MobileNo'] = $data["MobileNo"];
							$arrayData['personalMembership'] = $data["personalMembership"];
							$arrayData['loan_id'] = $data["loan_id"];
							$arrayData['transactionType'] = $data["transactionType"];
							$arrayData['loanAmountFigure'] = $data["loanAmountFigure"];
							$arrayData['loanAmountWords'] = $data["loanAmountWords"];
							$arrayData['loanType'] = $data["loanType"];
							$arrayData['loanTerm'] = $data["loanTerm"];
							$arrayData['paymentFrequency'] = $data["paymentFrequency"];
							$arrayData['loan_status'] = $data["loan_status"];
							$arrayData['created_at'] = $data["created_at"];
							$arrayData['reason'] = null;
							$arrayData['status'] = null;
							
					}
					
					array_push($payload, $arrayData);
						
				}
	
					if ($res['code'] == 200) {
						$payload = $payload;
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";
					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}
		

		public function adminget_voucherView($id)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM particular_tbl 	
										INNER JOIN payment_tbl 			ON particular_tbl.v_id = payment_tbl.v_id
										INNER JOIN signature_tbl 		ON payment_tbl.v_id = signature_tbl.v_id
										INNER JOIN voucher_tbl 			ON voucher_tbl.voucher_id = signature_tbl.v_id
										WHERE voucher_tbl.voucher_id =  $id";
			

				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function adminget_accountingView($id)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM acountingentry_tbl WHERE v_id = $id";
			

				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}

		public function filterData($search)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM voucher_tbl 
								WHERE (date LIKE '%$search%' )
								OR  (payee LIKE '%$search%' )
								OR (type LIKE '%$search%') " ;
				
				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}else{
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";
				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function get_notif($id) 
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				
				$sql = "SELECT * FROM notif INNER JOIN loaninformation_tbl ON notif.personal_id = loaninformation_tbl.personal_id";
				if ($id != null) {
					$sql.=" WHERE notif.user_id = $id";
				}

				$res = $this->gm->executeQuery($sql);
	
					if ($res['code'] == 200) {
						$payload = $res['data'];
						$code = 200;
						$remarks = "success";
						$message = "Successfully retrieved requested records";

					}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);
			}
		}

		public function searchLoan($search)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl
								 ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
								WHERE loaninformation_tbl.loan_status = 'Pending' ";
				if($search != null || $search != ""){
						$sql.="AND (Firstname LIKE '%$search%' )
								OR  (Lastname LIKE '%$search%' )
								OR (Department LIKE '%$search%')
								OR (personalMembership LIKE '%$search%')
								" ;
					}
				
								
				
				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}else{
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";
				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function searchLoan_approved($search)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl
								 ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
								WHERE loaninformation_tbl.loan_status != 'Pending' AND loaninformation_tbl.loan_status != 'Disapproved' ";
				if($search != null || $search != ""){
						$sql.="AND (Firstname LIKE '%$search%' )
								OR  (Lastname LIKE '%$search%' )
								OR (Department LIKE '%$search%')
								OR (personalMembership LIKE '%$search%')
								" ;
					}
				
								
				
				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}else{
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";
				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function searchLoan_History($search)
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";

			try {
				$sql = "SELECT * FROM personaldata_tbl INNER JOIN loaninformation_tbl
								 ON personaldata_tbl.personal_id = loaninformation_tbl.personal_id
								WHERE loaninformation_tbl.loan_status != 'Pending' AND loaninformation_tbl.loan_status != 'Approved'  ";
				if($search != null || $search != ""){
						$sql.="AND (Firstname LIKE '%$search%' )
								OR  (Lastname LIKE '%$search%' )
								OR (Department LIKE '%$search%')
								OR (personalMembership LIKE '%$search%')
								" ;
					}
				
								
				
				$res = $this->gm->executeQuery($sql);
				
				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}else{
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";
				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
		public function analitics()
		{
			$payload = [];
			$code = 404;
			$remarks = "failed";
			$message = "Unable to retrieve data";
			$date = date('Y');
			
			try {
				
				$sql = "SELECT SUBSTRING(created_at,6,2) as created_at, SUM(loanAmountFigure) as total_payment FROM loaninformation_tbl WHERE SUBSTRING(created_at,1,4) = '$date' AND loan_status != 'Disapproved' GROUP BY SUBSTRING(created_at,1,7)";
				$res = $this->gm->executeQuery($sql);

				if ($res['code'] == 200) {

					$payload = $res['data'];
					$code = 200;
					$remarks = "success";
					$message = "Successfully retrieved requested records";

				}

				return $this->gm->response($payload, $remarks, $message, $code);

			} catch (\PDOException $e) {

				return $this->gm->response($payload, $remarks, $message, $code);

			}
		}
	}
?>