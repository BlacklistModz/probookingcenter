<?php

$tr = "";
$tr_total = "";
if( !empty($this->results['lists']) ){ 

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) { 

        $option = "";
        foreach ($this->status as $key => $value) {
            $sel = "";
            if( $item["status"] == $value["id"] ){
                $sel = ' selected="1"';
            }
            $option.= '<option'.$sel.' value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        $status = '<select class="inputtext" data-plugins="_update" data-options="'.$this->fn->stringify(array('url' => URL. 'projects/setdata/'.$item['id'].'/pj_status')).'">'.$option.'</select>';

        // $item = $item;
        $cls = $i%2 ? 'even' : "odd";
        // set Name

        /*$updatedTime = strtotime( $item['updated'] );
        $updatedStr = date('j/m/Y', $updatedTime);
        $updatedStr .= '<div class="fsm fcg">' .date('H:i:s').'</div>';*/

        /*$created = strtotime( $item['created'] );
        $createdStr = date('j', $created) .' ' . $this->fn->q('time')->month( date('n', $created) ) .' '. ( date('Y', $created)+543 );*/


        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            // '<td class="check-box"><label class="checkbox"><input id="toggle_checkbox" type="checkbox" value="'.$item['id'].'"></label></td>'.

            
            '<td class="date">'.$this->fn->q('time')->full( strtotime($item["date"]), true). '</td>'.

            '<td class="email">'.$item["type"]["name"].'</td>'.

            '<td class="name">'.
                '<div class="anchor clearfix">'.
                    '<div class="content"><div class="spacer"></div><div class="massages">'.
                        '<div class="fullname"><a class="fwb">'. $item['name'].'</a></div>'.
                        '<div class="subname fsm meta fcg">Last Date: '.$this->fn->q('time')->live( $item['updated'] ).'</div>'.
                    '</div>'.
                '</div></div>'.
            '</td>'.
            
            '<td class="visit">'.$status.'</td>'.

        '</tr>';
        
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';