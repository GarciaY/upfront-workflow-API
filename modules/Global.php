<?php
	class GlobalMethods {
		protected $pdo;

		public function __construct(\PDO $pdo) {
			$this->pdo = $pdo;
		}

		public function executeQuery($sql) {
			$data = array();
			$errmsg = "";
			$code = 0;

			try {
				if($res = $this->pdo->query($sql)->fetchAll()) {
					foreach($res as $rec) {
						array_push($data, $rec);
					}
					$res = null;
					$code = 200;
					return array("code"=>$code, "data"=>$data);
				} else {
					$errmsg = "No records found";
					$code = 404;
				}
			} catch(\PDOException $e) {
				$errmsg = $e->getMessage();
				$code = 403;
			}
			return array("code"=>$code, "errmsg"=>$errmsg);
		}

		public function response($payload, $remarks, $message, $code) {
			$status = array("remarks"=>$remarks, "message"=>$message);
			http_response_code($code);
			return array("status"=>$status, "payload"=>$payload, "timestamp"=>date_create());
		}

	}
?>