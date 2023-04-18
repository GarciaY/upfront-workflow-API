<?php 
	require_once("./config/Config.php");
	require_once("./modules/Procedural.php");
	require_once("./modules/Global.php");
	require_once("./modules/Get.php");
	require_once("./modules/Post.php");
	require_once("./modules/Auth.php");

	$db = new Connection();
	$pdo = $db->connect();
	$get = new Get($pdo);
	$post = new Post($pdo);
	$auth = new Auth($pdo);

	if (isset($_REQUEST['request'])) {
		$req = explode('/', rtrim($_REQUEST['request'], '/'));
	} else {
		$req = array("errorcatcher");
	}

	switch($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			$d = json_decode(file_get_contents("php://input"));

			switch ($req[0]) {

				//auth
				case 'changePass':
					echo json_encode($auth->changePass($d,$req[1]));
					break;

				case 'admin_login':
					echo json_encode($auth->admin_login($d));
					break;

				case 'user_login':
					echo json_encode($auth->user_login($d));
					break;

				case 'admin_Register':
					echo json_encode($auth->admin_Register($d));
					break;

				case 'user_signup':
					echo json_encode($auth->user_signup($d));
					break;	
	
				// post
				case'update_loan_disapproved':
					echo json_encode($post->update_loan_disapproved($req[1]));
					break;

				case 'update_loan':
					echo json_encode($post->update_loan_approved($req[1]));
					break;

				case 'update_loan_release':
					echo json_encode($post->update_loan_release($req[1]));
					break;
					
				case 'add_voucher':
					echo json_encode($post->add_voucher($d));
					break;
					
				case 'accountinEntry':
					echo json_encode($post->accountinEntry($d));
					break;

				case 'add_loan':
					echo json_encode($post->add_loan($d));
					break;
				
				case 'create_notif':
					echo json_encode($post->create_notif($d));
					break;

				case 'read_notif':
					echo json_encode($post->read_notif($req[1]));
					break;

				//get
				case 'searchLoan':
					echo json_encode($get->searchLoan($req[1]));
					break;

				case 'searchLoan_approved':
					echo json_encode($get->searchLoan_approved($req[1]));
					break;

				case 'searchLoan_History':
					echo json_encode($get->searchLoan_History($req[1]));
					break;

				case 'History':
					echo json_encode($get->adminget_Loan_history());
					break;

				case 'adminget_Loan_one':
					echo json_encode($get->adminget_Loan_one($req[1]));
					break;

					case 'adminget_Loan_one_user':
						echo json_encode($get->adminget_Loan_one_user($req[1]));
						break;

				case 'adminget_allLoan':
					echo json_encode($get->adminget_allLoan());
					break;
					
				case 'analitics':
					echo json_encode($get->analitics());
					break;

				case 'adminget_Loan':
					echo json_encode($get->adminget_Loan());
					break;

				case 'get_Loan':
					echo json_encode($get->get_Loan($req[1]));
					break;

				case 'get_voucher':
					echo json_encode($get->get_voucher());
					break;

				case 'adminget_voucherView':
					echo json_encode($get->adminget_voucherView($req[1]));
					break;
					
				case 'adminget_accountingView':
					echo json_encode($get->adminget_accountingView($req[1]));
					break;

				case 'adminget_voucher':
					echo json_encode($get->adminget_voucher());
					break;
					
				case 'get_notif':
					echo json_encode($get->get_notif($req[1]));
					break;

				case 'filterData':
					echo json_encode($get->filterData($req[1]));
					break;

				//delette
				case 'deleteVoucher':
					echo json_encode($post->deleteVoucher($req[1]));
					break;

				case 'deleteLoan':
					echo json_encode($post->deleteLoan($req[1]));
					break;

				default:
					echo errmsg(400);
				break;
			}
			break;

		default:
			echo errmsg(403);
	}
?>