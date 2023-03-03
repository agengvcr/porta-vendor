<?php
namespace App\Libs;

use \Carbon\Carbon;
class Helper{

	public static function formatSubContract($id,$period,$subId){

		return $id.'.'.$period.'.'.$subId;
	}

	public static function unitStatus($unitInLocation , $unitInSubContract){
		if($unitInLocation == $unitInSubContract){
			return trans('fields.actual');
		}
		else{
			return trans('fields.gs');
		}
	}

	public static function clientShortName($text){
		if(strlen($text) > 10 ){
			return substr($text,0,15).'...';
		}
		else{
			return $text;
		}
	}

	public static function getReceipt($text,$status){

        try {
        	if($status = 'DELIVERED'){
        		$data = explode(":",$text);
            	$result = trim($data[1]);
            	return $result;
        	}
        	else{
        		return '-';
        	}

        } catch (\Exception $e) {}

        return false;
	}

	public static function iconWorkOrder($type,$status){
		if($type =='wo'){
			if($status == 'Pending Revision')
            {
                return 'ri-time-line ';
            }
            else if($status == 'Approved')
            {
                return 'ri-check-line ';
            }
            else if($status == 'Executed')
            {
                return 'ri-mail-send-line ';
            }
            else if($status == 'Issue Found')
            {
                return 'ri-alarm-warning-line ';
            }
			else if($status == 'Paid')
            {
                return 'ri-chat-check-line ri-lg';
            }
		}
	}

	public static function statusWO($type, $status)
	{
		if($type == 'wo')
		{
			if($status == 1){
				return trans('fields.pending');
			}
			elseif($status == 2){
				return trans('fields.approved');
			}
			elseif($status == 3){
				return trans('fields.execute');
			}
			elseif($status == 4){
				return trans('fields.waitingForInvoice');
			}
			elseif($status == 7){
				return trans('fields.settled');
			}
			elseif($status == 5){
				return trans('fields.outStanding');
			}
			elseif($status == 6){
				return trans('fields.paid');
			}
			elseif($status == 8){
				return trans('fields.issueFound');
			}
			else
			{
				return trans('fields.paid');
			}
		}
		if($type == 'subEdit')
		{
			if($status == 1){
				return trans('fields.declined');
			}
			elseif($status == 2){
				return trans('fields.pending');
			}
			elseif($status == 3){
				return trans('fields.approved');
			}
		}
		if($type == 'inputStatus')
		{
			if($status == trans('fields.pending')){
				return 'info';
			}
			elseif($status == trans('fields.approved')){
				return 'success';
			}
			elseif($status == trans('fields.declined')){
				return 'danger';
			}
		}
	}

	public static function timeLineColor($status){
		if($status == 'Issue Found'){
			return 'red';
		}
		if($status == 'Issue Solved'){
			return 'orange';
		}

		if($status == 'Outstanding'){
			return 'orange';
		}
		if($status == 'Invoice Declined'){
			return  'red';
		}
		if($status == 'Waiting for Invoice'){
			return 'orange';
		}
		if($status == 'Settled'){
			return 'aqua';
		}if($status == 'Invoice Processed'){
			return 'orange';
		}if($status == 'Paid'){
			return 'green';
		}

		if($status == 'Processing Payment'){
			return 'orange';
		}

		if($status == 'Invoice Uploaded'){
			return 'orange';
		}if($status == 'Invoice Accepted'){
			return 'orange';
		}if($status == 'Invoice Declined' || $status =='Declined'){
			return 'red';
		}
	}
	public static function statusColor($type,$status){
		if($type == 'callCenter'){
			if($status == 'SUCCESS'){
				return 'success';
			}
			elseif($status == 'INPROGRESS'){
				return 'warning';
			}
			elseif($status == 'FAILED'){
				return 'danger';
			}
		}
		elseif($type == 'clientcc'){
			if(!empty($status)){
				return 'warning';
			}
			else{
				return 'success';
			}
		}
		elseif($type == 'clientio'){
			if($status == 1){
				return 'danger';
			}elseif($status == 2){
				return 'success';
			}
			else{
				return 'warning';
			}
		}
		elseif($type == 'doPayment'){
			if($status == 'Paid'){
				return 'success';
			}
			else if ($status == 'Issue'){
				return 'danger';
			}
			else if($status == 'Outstanding'){
				return 'warning';
			}
			else{
				return 'primary';
			}
		}
		elseif($type == 'movement'){
			if($status == 'OUT'){
				return 'danger';
			}
			elseif($status == 'IN'){
				return 'info';
			}
		}
		elseif($type == 'unit'){
			if($status == trans('fields.gs')){
				return 'warning';
			}
			else{
				return 'success';
			}
		}
		elseif($type == 'invoice'){
			if($status == trans('fields.paid')){
				return 'success';
			}
			else{
				return  'warning';
			}
		}
		elseif($type == 'invoicereceipt'){
			if($status == 'DELIVERED'){
				return 'success';
			}
			elseif($status == 'ON PROCESS'){
				return  'warning';
			}
			else{
				return 'danger';
			}
		}
		elseif($type == 'progressbar'){
			if($status <= 80 ){
				return 'warning';
			}
			else{
				return 'danger';
			}
		}
		elseif($type == 'taxReceipt'){
			if(!empty($status)){
				return 'warning';
			}
			else{
				return 'success';
			}
		}
		elseif ($type == 'wo')
		{
			if ($status == 'Waiting for Invoice' || $status == 'Invoice Processed' || $status == 'WFI' || $status == 'Pending Revision')
			{
				return 'warning';
			}
			elseif ($status == 'Invoice Accepted')
			{
				return 'warning';
			}
			elseif ($status == 'Issue Found' || $status == 'Invoice Declined' || $status =='Declined')
			{
				return 'danger';
			}
			elseif ($status == 'Outstanding' || $status == 'Invoice Uploaded' )
			{
				return 'warning';
			}elseif ($status == 'Settled' || $status == 'Processing Payment' || $status == 'Approved'  )
			{
				return 'info';
			}
			elseif($status == 'Executed' || $status == 'Paid')
			{
				return 'success';
			}
		}

		elseif($type == 'woIe'){
			if($status == 'Approved'){
				return 'success';
			}elseif($status == 'Pending'){
				return 'warning';
			}elseif($status == 'Declined'){
				return 'danger';
			}

		}
		elseif($type == 'woIi'){
			if ($status == 'Declined')
			{
				return 'danger';
			}
			elseif ($status == 'Approved')
			{
				return 'success';
			}
			elseif ($status == 'Pending')
			{
				return 'info';
			}
		}
	}

	public static function statusWoIi($status){
		if ($status == 1)
		{
			return 'Declined';
		}
		elseif ($status == 2)
		{
			return 'Approved';
		}
		elseif ($status == 3)
		{
			return 'Pending';
		}
	}

	public static function diffDay($dateFrom,$dateTo){
		$dateFrom = Carbon::parse($dateFrom);
		$dateTo = Carbon::parse($dateTo);

		return $dateFrom->diffInDays($dateTo);
	}
	public static function expiredDocument($dateFrom,$dateTo){
		$dateFrom = Carbon::parse($dateFrom);
		$dateTo = Carbon::parse($dateTo);
		if(Carbon::now()->gt(Carbon::parse($dateFrom))){
			$result = 'Expired';
		}else{
			$result = $dateFrom->diffInDays($dateTo).' Days';
		}
		return $result;
	}

	public static function getColorExpired($expiredDate){
		if(Carbon::parse($expiredDate) <= Carbon::now()){
			return 'danger';
		}
		else{
			return 'warning';
		}
	}

	public static function typeRent($type){
		if($type == 'd'){
			return 'DAILY';
		}
		elseif($type == 'm'){
			return 'MONTHLY';
		}
		elseif($type == 'y'){
			return 'YEARLY';
		}
	}

	public static function formatNumber($number, $credit=false, $decimal=0, $prefix='Rp. ') {
        if($number == null) return '';
        if($credit) {
            $number = $number * -1;
        }

        return ($number < 0) ?
            sprintf('(%s)', $prefix.number_format(abs($number),$decimal)) : $prefix.number_format($number,$decimal);
    }

    public static function getLogo(){
    	if(session('name') == 'PT. TIKI JALUR NUGRAHA EKAKURIR'){
    		return 'images/tiki.png';
    	}
    	elseif(session('name') == 'BATAVIA PROSPERINDO FINANCE TBK'){
    		return 'images/bpf.png';
    	}
    	elseif(session('name') == 'PT. JASA BERDIKARI LOGISTICS'){
    		return 'images/jbl.jpg';
    	}
    	else{
    		return 'images/client.png';
    	}
    }
    public static function getFilter($request){

    	$filter = new \stdClass();

    	//filter global text
    	$filter->filterTexts = preg_split('/(-|\/)/', $request->input('search')['value']);

    	//pagination
    	$filter->pageLimit = $request->input('length') ?: 100;
        $filter->pageOffset = $request->input('start') ?: 0;

        //sorting
        $columns = $request->input('columns') == null ? array() : $request->input('columns');
        $filter->sortColumns = array();
        $orderColumns = $request->input('order') != null ? $request->input('order') : array();

        foreach ($orderColumns as $value){
            $sortColumn = new \stdClass();
            $sortColumn->field = $columns[$value['column']]['data'];
            if (empty($sortColumn->field)) continue;

            $sortColumn->dir = $value['dir'];
            array_push($filter->sortColumns, $sortColumn);
        }

        return $filter;
    }

    public static function createFile($file,$extension,$filename){


			header('Content-Description: File Transfer');
			header('Content-Type: application '.self::getMimeType($extension));
			header('Content-Disposition: attachment; filename='.$filename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . strlen($file));
			ob_clean();
			flush();

			echo $file;
			exit;
    }


    public static function getMimeType($extension){
    	if(strtolower($extension) == 'pdf'){
    		return 'application/pdf';
    	}elseif (strtolower($extension) == 'jpg') {
    		return 'image/jpg';
    	}
    }

    public static function googleAnalyticUserId()
    {
        if (!empty(session(GlobalVar::USERID))) {
            return str_replace(' ', '_',
                session(GlobalVar::USERID) . '-' . session(GlobalVar::USER_NAME) . '-' . session(GlobalVar::NAME)
            );
        } else {
            return '-';
        }
    }

	public static function statusWOOld($type, $status)
	{
		if($type == 'wo')
		{
			if($status == 1){
				return trans('fields.pendingRev');
			}
			elseif($status == 2){
				return trans('fields.approved');
			}
			elseif($status == 3){
				return trans('fields.execute');
			}
			elseif($status == 4){
				return trans('fields.waitingForInvoice');
			}
			elseif($status == 7){
				return trans('fields.settled');
			}
			elseif($status == 5){
				return trans('fields.outStanding');
			}
			elseif($status == 6){
				return trans('fields.paid');
			}
			elseif($status == 8){
				return trans('fields.issueFound');
			}
			else
			{
				return trans('fields.paid');
			}
		}
		if($type == 'subEdit')
		{
			if($status == 1){
				return trans('fields.declined');
			}
			elseif($status == 2){
				return trans('fields.pending');
			}
			elseif($status == 3){
				return trans('fields.approved');
			}
		}
		if($type == 'inputStatus')
		{
			if($status == trans('fields.pending')){
				return 'info';
			}
			elseif($status == 'Approved'){
				return 'success';
			}
			elseif($status == trans('fields.declined')){
				return 'warning';
			}
		}
	}

    public static function status($type, $status){
        $status = ($status == 'ISSUEBEFORERECEIVE' || $status == 'ISSUEEXTERNAL') ? 'ISSUEFOUND' : $status;
        $result = [
            'WO' => [
                'APPROVED' => ['status' => $status, 'icon' => 'ri-check-line', 'color' => 'info'],
                'EXECUTED' => ['status' => $status, 'icon' => 'ri-mail-send-line', 'color' => 'success'],
                'REVISIONAPPROVED' => ['status' => $status, 'icon' => 'ri-time-line', 'color' => 'warning'],
                'ISSUEFOUND' => ['status' => $status, 'icon' => 'ri-alarm-warning-line', 'color' => 'danger'],
				'' => ['status' => null, 'icon' => null, 'color' => null],
				'DECLINED' => ['status' => $status, 'icon' => 'ri-close-line', 'color' => 'danger'],
				'RECEIVED' => ['status' => $status, 'icon' => 'ri-check-line', 'color' => 'info'],

				'SETTLED' => ['status' => $status, 'icon' => 'las la-handshake', 'color' => 'success'],


            ],
            'WOINPUTESTIMATE' => [
                'PENDING' => ['status' => $status, 'icon' => 'ri-time-line', 'color' => 'info'],
                'APPROVED' => ['status' => $status, 'icon' => 'ri-check-line', 'color' => 'success'],
                'DECLINED' => ['status' => $status, 'icon' => 'ri-alarm-warning-line', 'color' => 'danger'],
            ],
            'WOINPUTINVOICE' => [
                'PENDING' => ['status' => $status, 'icon' => 'ri-time-line', 'color' => 'info'],
                'APPROVED' => ['status' => $status, 'icon' => 'ri-check-line', 'color' => 'success'],
                'DECLINED' => ['status' => $status, 'icon' => 'ri-close-line', 'color' => 'danger'],
            ],
            'PAYMENT' => [
                'PAID' => ['status' => $status, 'icon' => 'ri-chat-check-line', 'color' => 'success'],
                'WAITINGFORINVOICE' => ['status' => $status, 'icon' => 'ri-time-line', 'color' => 'warning'],
                'INVOICEUPLOADED' => ['status' => $status, 'icon' => 'ri-file-upload-line', 'color' => 'warning'],
                'INVOICEACCEPTED' => ['status' => $status, 'icon' => 'ri-mail-check-line', 'color' => 'warning'],
                'INVOICEDECLINED' => ['status' => $status, 'icon' => 'ri-close-circle-line', 'color' => 'danger'],
                'INVOICEPROCESSED' => ['status' => $status, 'icon' => 'ri-settings-5-line', 'color' => 'warning'],
                'PROCESSINGPAYMENT' => ['status' => $status, 'icon' => 'ri-bank-card-line', 'color' => 'info'],
                'OUTSTANDING' => ['status' => $status, 'icon' => 'ri-refresh-line', 'color' => 'warning'],
                'ISSUEFOUND' => ['status' => $status, 'icon' => 'ri-error-warning-line', 'color' => 'danger'],
				'DECLINED' => ['status' => $status, 'icon' => 'ri-close-line', 'color' => 'danger'],
				'RECEIVED' => ['status' => $status, 'icon' => 'ri-check-line', 'color' => 'info'],

			],
			'EXPEDITION' => [
                'PAID' => ['status' => $status, 'icon' => 'ri-bank-card-fill', 'color' => 'success'],
                'OUTSTANDING' => ['status' => $status, 'icon' => 'ri-bank-card-fill', 'color' => 'warning'],
                'ISSUED' => ['status' => $status, 'icon' => 'ri-alarm-warning-fill ', 'color' => 'danger'],
				'WAITINGFORINVOICE' => ['status' => $status, 'icon' => 'ri-time-line', 'color' => 'primary']
			],

			'INPUTLOCATION' => [
                'APPROVED' => ['status' => $status, 'icon' => '', 'color' => 'success'],
                'DECLINED' => ['status' => $status, 'icon' => '', 'color' => 'danger'],
                'PENDING' => ['status' => $status, 'icon' => '', 'color' => 'info'],
			],

			'NONE' => [
                'NONE' => ['status' => null, 'icon' => null, 'color' => null],
			],

        ];

        return (object)$result[$type][$status];
    }

}
?>
