<?php
/* *****************************************************
    ** WHMCS Jalali Dates **
    By Ehsan Chavoshi (HostFa) & Amin Arjmand (https://github.com/sibche2013)
    Date : 2016-04-23
    Lincense : MIT License
    Source : https://github.com/EhsanCh/whmcs-jalalidate
***************************************************** */

add_hook('ClientAreaPage', 1, function($templateVariables) {
    // Look for an existing template variable.
    if (! in_array($templateVariables['language'],array('farsi','persian','فارسی')))
        return;
    $templateVariables['jdate'] = TRUE;
    foreach ($templateVariables['announcements'] as &$announcements) {
        //$announcements['date'] = $announcements['timestamp'] ? jdate("j F Y", $announcements['timestamp']) : jdate("j F Y", strtotime($announcements['rawDate']));
		$announcements['rawDate'] = jdate("j F Y", strtotime($announcements['rawDate']));
		$announcements['timestamp'] = jdate("j F Y", $announcements['timestamp']);
    }
    foreach ($templateVariables['domains'] as &$domains) {
        $domains['registrationdate'] = '<span class="text-info">'.date("Y/m/d",strtotime($domains['normalisedRegistrationDate'])).'&nbsp;('.jdate("Y/m/d", strtotime($domains['normalisedRegistrationDate'])).')</span>';
        $domains['nextduedate'] = '<span class="text-danger">'.date("Y/m/d",strtotime($domains['normalisedNextDueDate'])).'&nbsp;('.jdate("Y/m/d", strtotime($domains['normalisedNextDueDate'])).')</span>';
    }
    foreach ($templateVariables['renewals'] as &$renewals) {
        $renewals['expiryDate'] = '<span class="text-danger">'.date("Y/m/d",strtotime($renewals['normalisedExpiryDate'])).'&nbsp;('.jdate("Y/m/d", strtotime($renewals['normalisedExpiryDate'])).')';
    }
    foreach ($templateVariables['quotes'] as &$quotes) {
        $quotes['datecreated'] = '<span class="text-danger">'.date("Y/m/d",strtotime($quotes['normalisedDateCreated'])).'&nbsp;('.jdate("Y/m/d", strtotime($quotes['normalisedDateCreated'])).')';
        $quotes['validuntil'] = '<span class="text-danger">'.date("Y/m/d",strtotime($quotes['normalisedValidUntil'])).'&nbsp;('.jdate("Y/m/d", strtotime($quotes['normalisedValidUntil'])).')';
    }
    foreach ($templateVariables['services'] as &$services) {
        $services['regdate'] = jdate("Y/m/d", strtotime($services['normalisedRegDate']));
        $services['nextduedate'] = '<span class="text-danger">'.date("Y/m/d",strtotime($services['normalisedNextDueDate'])).'&nbsp;('.jdate("Y/m/d", strtotime($services['normalisedNextDueDate'])).')</span>';
    }
    foreach ($templateVariables['tickets'] as &$tickets) {
        //$tickets['date'] = jdate("Y/m/d H:i", strtotime($tickets['normalisedDate']));
        $tickets['lastreply'] = '<span class="text-danger">'.jdate("Y/m/d H:i", strtotime($tickets['normalisedLastReply'])).'</span>';
    }
/*  foreach ($templateVariables['replies'] as &$replies) {
        $replies['date'] = jdate("Y/m/d H:i", strtotime($replies['date']));
    }
    foreach ($templateVariables['ascreplies'] as &$ascreplies) {
        $ascreplies['date'] = jdate("Y/m/d H:i", strtotime($ascreplies['date']));
    }*/
    foreach ($templateVariables['descreplies'] as &$descreplies) {
        $descreplies['date'] = '<span class="text-info">'.jdate("Y/m/d H:i", strtotime($descreplies['date'])).'</span>';
    }
    foreach ($templateVariables['invoices'] as &$invoices) {
        $invoices['datecreated'] = '<span class="text-danger">'.date("Y/m/d", strtotime($invoices['normalisedDateCreated'])).'&nbsp;('.jdate("Y/m/d", strtotime($invoices['normalisedDateCreated'])).')</span>';
        $invoices['datedue'] = '<span class="text-danger">'.date("Y/m/d", strtotime($invoices['normalisedDateDue'])).'&nbsp;('.jdate("Y/m/d", strtotime($invoices['normalisedDateDue'])).')</span>';
    }
    foreach ($templateVariables['transactions'] as &$transactions) {
        $transactions['date'] = '<span class="text-danger">'.date("Y/m/d", strtotime($transactions['date'])).'&nbsp;('.jdate("Y/m/d", strtotime($transactions['date'])).')</span>';
    }
    foreach ($templateVariables['emails'] as &$emails) {
        $emails['date'] = '<span class="text-info">'.date("Y/m/d", strtotime($emails['normalisedDate'])).'&nbsp;('.jdate("Y/m/d", strtotime($emails['normalisedDate'])).')</span>';
    }
    if ($templateVariables['date']) {
        $templateVariables['jfulldate'] = jdate("l ، j F Y", strtotime($templateVariables['date']));
    }
    
    $datefields = array('nextduedate','expirydate','lastupdate','date','duedate','datepaid','datecreated','datedue');

    foreach ($datefields as $datefield) {
        if ($templateVariables[$datefield])
            $templateVariables[$datefield] = '<span class="text-danger">'.date("Y/m/d",strtotime($templateVariables[$datefield])).'&nbsp;('.jdate("Y/m/d", strtotime($templateVariables[$datefield])).')</span>';
    }
	$datefields1 = array('registrationdate','regdate');
	foreach ($datefields1 as $datefield2) {
        if ($templateVariables[$datefield2])
            $templateVariables[$datefield2] = '<span class="text-info">'.date("Y/m/d",strtotime($templateVariables[$datefield2])).'&nbsp;('.jdate("Y/m/d", strtotime($templateVariables[$datefield2])).')</span>';
    }
    
 
//    echo "<pre>";
//    print_r($templateVariables);
//    echo "</pre>";

    return $templateVariables;
});
