<?php 

$fullname = $this->book['agen_fname'];
$this->book['agen_lname'] = str_replace("-", "", $this->book['agen_lname']);
if( !empty($this->book['agen_lname']) ){
	$fullname .= ' '.$this->book['agen_lname'];
}

$button="";
if(($this->me['role']=="admin" || $this->me['id'] == $this->book['agen_id']) &&!empty($this->book['passport'])){
    $button = '<a href="'.URL.'/booking/passport_view/'.$this->book['book_id'].'"class="btn btn-blue"><i class="icon-eye"></i></a> <a href="'.URL.'/booking/passport_view/'.$this->book['book_id'].'"class="btn btn-blue"><i class="icon-book"> ดู Passport</i></a>';
}

//
$html = '<div class="clearfix">
 
        		<div id="" class="" style="">
        			<div class="span4" style="margin-left: 25px;">
                        <div class="uiBoxWhite pam">
                        <table><tbody>
                            <tr><td class="clearfix fwb pbm"><i class="icon-address-book-o mrs"></i>ข้อมูลผู้จอง</td></tr>
                            <tr><td>'.$fullname.'</td></tr>
                            <tr><td>'.$this->book['agen_email'].'</td></tr>
                            <tr><td>'.$this->book['agen_tel'].'</td></tr>
                            <tr><td>'.$this->me['company_name'].'</td></tr>
                        </tbody></table>
                        </div>
                    </div>

                    <div class="span4" style="margin-left: 25px;">
                        <div class="uiBoxWhite pam">
                        <table><tbody>
                            <tr><td class="clearfix fwb pbm"><i class="icon-plane mrs"></i>ข้อมูลการเดินทาง</td></tr>
                            <tr><td>Code: <span class="text-blue">'.$this->item['code'].'</span></td></tr>
                            <tr><td>'.$this->item['name'].'</td></tr>
                            <tr><td>'.$this->fn->q('time')->str_event_date($this->item['per_date_start'], $this->item['per_date_end']).'</td></tr>
                            <tr><td><span class="text-red">'.$this->item['air_name'].'</span> เส้นทาง '.$this->item['ser_route'].'</td></tr>
                        </tbody></table>
                        </div>
                    </div>

                    <div class="span4" style="margin-left: 25px;">
                        <div class="uiBoxWhite pam">
                        <table><tbody>
                            <tr>
                                <td colspan="2" class="clearfix fwb pbm"><i class="icon-money mrs"></i>INVOICE</td>
                            </tr>
                            <tr>
                                <td>Code:</td>
                                <td>'.$this->book['invoice_code'].'</td>
                            </tr>

                            <tr>
                                <td>Deposit Date:</td>
                                <td> '.( $this->book['book_due_date_deposit']=='0000-00-00 00:00:00' ? '-': date('Y-m-d', strtotime($this->book['book_due_date_deposit'])) ).'</td>
                            </tr>

                            <tr>
                                <td>Deposit Price:</td>
                                <td>'.( $this->book['book_master_deposit']==0 ? '-': number_format($this->book['book_master_deposit']) ).'</td>
                            </tr>
                            <tr>
                                <td>Full Payment Date:</td>
                                <td style="color: #9e0000;font-size: 18px">'.( date('Y-m-d', strtotime($this->book['book_due_date_full_payment'])) ).'</td>
                            </tr>
                            <tr>
                                <td>Full Payment Price:</td>
                                <td style="color: #0a0b92;font-size: 18px">'.( number_format($this->book['book_master_full_payment']) ).'.-</td>
                            </tr>

                        </tbody></table>
                        </div>
                    </div>

                    <div class="span4" style="margin-left: 25px;">
                        <div class="uiBoxWhite pam">
                        <table><tbody>
                            <tr>
                                <td colspan="2" class="clearfix fwb pbm"><i class="icon-info mrs"></i>ข้อมูลลูกค้า</td>
                            </tr>
                            <tr>
                                <td>ชื่อลูกค้า</div>
                                <td>'.(!empty($this->book['book_cus_name']) ? $this->book['book_cus_name'] : "-").'</td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรลูกค้า</div>
                                <td>'.(!empty($this->book['book_cus_tel']) ? $this->book['book_cus_tel'] : "-").'</td>
                            </tr>
                        </tbody></table>
                        </div>
                    </div>

                    <div class="span4" style="margin-left: 25px;">
                        <div class="uiBoxWhite pam">
                        <table><tbody>
                            <tr>
                                <td colspan="2" class="clearfix fwb pbm"><i class="icon-info mrs"></i>หมายเหตุ</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="clearfix">'.(!empty($this->book['book_comment']) ? $this->book['book_comment'] : "-").'</td>
                            </tr>
                            <tr>
                            <a></a>
                            </tr>
                        </tbody></table>
                        </div>
                    </div>
                    <div class="clearfix" style="margin-top:1rem;"><span></span></div>
                    
        		</div>

        </div>';

$arr['form'] = '<div style="color:#000;"></div>';
$arr['title'] = $this->book['book_code'];
$arr['body'] = $html;

// $arr['button'] = '<a href="" class="btn btn-cancel" role="dialog-close"><i class="icon-remove"></i></a>';
//$arr['bottom_msg'] = '<a href="'.URL.'/booking/passport/'.$this->book['book_id'].'" role="dialog-close" data-plugins="dialog" class="btn btn-blue"><i class="icon-upload"></i> Passport upload</a> '.$button;
// $arr['width'] = 1270;
$arr['is_close_bg'] = true;

echo json_encode($arr);

