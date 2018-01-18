<?php

$tr = "";
$tr_total = "";
$url = URL .'user/';
if( !empty($this->results['lists']) ){ 

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) { 


        // $item = $item;
        $cls = $i%2 ? 'even' : "odd";
        // set Name

        $image = '';
        $subtext = '';
        $express = '';
        $disabled = '';
        $dropdown = array();

        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            // '<td class="check-box"><label class="checkbox"><input id="toggle_checkbox" type="checkbox" value="'.$item['id'].'"></label></td>'.

            // '<td class="bookmark"><a class="ui-bookmark js-bookmark'.( $item['bookmark']==1 ? ' is-bookmark':'' ).'" data-value="" data-id="'.$item['id'].'" stringify="'.URL.'customers/bookmark/'.$item['id']. (!empty($this->hasMasterHost) ? '?company='.$this->company['id']:'') .'"><i class="icon-star yes"></i><i class="icon-star-o no"></i></a></td>'.

            '<td class="name">'.

                '<div class="anchor clearfix">'.
                    $image.
                    
                    '<div class="content"><div class="spacer"></div><div class="massages">'.

                        '<div class="fullname"><a class="fwb">'. $item['fullname'].'</a> <span class="fwn">@'. $item['name'].'</span></div>'.

                        '<div class="subname fsm fcg meta">'.$subtext.'</div>'.

                        // '<div class="fss fcg whitespace">Last update: '.$this->fn->q('time')->live( $item['updated'] ).'</div>'.
                    '</div>'.
                '</div></div>'.

            '</td>'.

            '<td class="express"><ul class="fsm">'.$express.'</ul></td>'.
            '<td class="actions whitespace">'.

                '<div class="fss fcg">'.$this->fn->q('time')->live( $item['update_date'] ).'</div>'.
                
            '</td>'.
              
        '</tr>';
        
    }
}

$table = '<table class="settings-table"><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';