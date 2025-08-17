<?php
/* *****************************************************
 ** WHMCS Jalali Dates **
 By Ehsan Chavoshi (HostFa) & Amin Arjmand (https://github.com/sibche2013) & Hamid Ghouli (https://github.com/hamidghouli)
 Date : 2016-04-23
 Updated : 2025-08-17
 Lincense : MIT License
 Source : https://github.com/EhsanCh/whmcs-jalalidate Or https://github.com/sibche2013/whmcs-jalalidate (WHMCS 7.1.1 Updated)
 ***************************************************** */
add_hook('ClientAreaPage', 1, function($templateVariables)
{
    // Look for an existing template variable.
    if (!in_array($templateVariables['language'], array(
        'farsi',
        'persian',
        'فارسی'
    )))
        return;
    $templateVariables['jdate'] = TRUE;
    
    // Invoices Jalali Date - clientarea.php?action=invoices
    foreach ($templateVariables['invoices'] as &$invoices) {
        if (strtotime($invoices['datecreated']) > 0)
            $invoices['datecreated'] = '<span class="text-info">' . date("Y/m/d", strtotime($invoices['normalisedDateCreated'])) . '<br>' . jdate("Y/m/d", strtotime($invoices['normalisedDateCreated'])) . '</span>';
        if (strtotime($invoices['datedue']) > 0)
            $invoices['datedue'] = '<span class="text-danger">' . date("Y/m/d", strtotime($invoices['normalisedDateDue'])) . '<br>' . jdate("Y/m/d", strtotime($invoices['normalisedDateDue'])) . '</span>';
    }
    
    // Quotes Jalali Date - clientarea.php?action=quotes
    foreach ($templateVariables['quotes'] as &$quotes) {
        if (strtotime($quotes['datecreated']) > 0)
            $quotes['datecreated'] = '<span class="text-info">' . date("Y/m/d", strtotime($quotes['normalisedDateCreated'])) . '<br>' . jdate("Y/m/d", strtotime($quotes['normalisedDateCreated'])) . '</span>';
        if (strtotime($quotes['validuntil']) > 0)
            $quotes['validuntil'] = '<span class="text-danger">' . date("Y/m/d", strtotime($quotes['normalisedValidUntil'])) . '<br>' . jdate("Y/m/d", strtotime($quotes['normalisedValidUntil'])) . '</span>';
    }
    
    // Domains Jalali Date - clientarea.php?action=domains
    foreach ($templateVariables['domains'] as &$domains) {
		if (!is_array($domains))
			continue;
        if (strtotime($domains['registrationdate']) > 0)
            $domains['registrationdate'] = '<span class="text-info">' . date("Y/m/d", strtotime($domains['normalisedRegistrationDate'])) . '<br>' . jdate("Y/m/d", strtotime($domains['normalisedRegistrationDate'])) . '</span>';
        if (strtotime($domains['nextduedate']) > 0)
            $domains['nextduedate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($domains['normalisedNextDueDate'])) . '<br>' . jdate("Y/m/d", strtotime($domains['normalisedNextDueDate'])) . '</span>';
    }
    
    // Domains Renewal Jalali Date - clientarea.php?action=domains#tabRenew
    foreach ($templateVariables['renewals'] as &$renewals) {
        if (strtotime($renewals['expiryDate']) > 0)
            $renewals['expiryDate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($renewals['normalisedExpiryDate'])) . '<br>' . jdate("Y/m/d", strtotime($renewals['normalisedExpiryDate'])) . '</span>';
    }
    
    // Services Jalali Date - clientarea.php?action=services
    foreach ($templateVariables['services'] as &$services) {
        if (strtotime($services['regdate']) > 0)
            $services['regdate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($services['normalisedRegDate'])) . '<br>' . jdate("Y/m/d", strtotime($services['normalisedRegDate'])) . '</span>';
        if (strtotime($services['nextduedate']) > 0)
            $services['nextduedate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($services['normalisedNextDueDate'])) . '<br>' . jdate("Y/m/d", strtotime($services['normalisedNextDueDate'])) . '</span>';
    }
    
    // Tickets Last Reply Jalali Date - supporttickets.php
    foreach ($templateVariables['tickets'] as &$tickets) {
        if (strtotime($tickets['lastreply']) > 0)
            $tickets['lastreply'] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($tickets['normalisedLastReply'])) . '<br>' . jdate("Y/m/d H:i", strtotime($tickets['normalisedLastReply'])) . '</span>';
    }
    
    // Tickets Reply Jalali Date - viewticket.php?tid=xxx
    foreach ($templateVariables['descreplies'] as &$descreplies) {
        if (strtotime($descreplies['date']) > 0)
            $descreplies['date'] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($descreplies['date'])) . '<br>' . jdate("Y/m/d H:i", strtotime($descreplies['date'])) . '</span>';
    }
    
    // Emails History Jalali Date - clientarea.php?action=emails
    foreach ($templateVariables['emails'] as &$emails) {
        if (strtotime($emails['date']) > 0)
            $emails['date'] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($emails['normalisedDate'])) . '<br>' . jdate("Y/m/d H:i", strtotime($emails['normalisedDate'])) . '</span>';
    }
    
    // Announcement Jalali Date - announcements.php
    foreach ($templateVariables['announcements'] as &$announcements) {
        $announcements['date']   = jdate("j F Y", strtotime($announcements['rawDate']));
																				  
    }
    
    // ServerStatus Jalali Date - serverstatus.php
    foreach ($templateVariables['issues'] as &$issues) {
        $issues['startdate']   = '<span class="text-danger">' . date("Y/m/d H:i", strtotime($issues['startdate'])) . '&nbsp;(' . jdate("Y/m/d H:i", strtotime($issues['startdate'])) . ')</span>';
        $issues['lastupdate'] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($issues['lastupdate'])) . '&nbsp;(' . jdate("Y/m/d H:i", strtotime($issues['lastupdate'])) . ')</span>'; 
        $issues['enddate'] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($issues['enddate'])) . '&nbsp;(' . jdate("Y/m/d H:i", strtotime($issues['enddate'])) . ')</span>'; 
    }
    
    // Transactions Jalali Date
    foreach ($templateVariables['transactions'] as &$transactions) {
        $transactions['date'] = '<span class="text-info">' . date("Y/m/d", strtotime($transactions['date'])) . '<br>' . jdate("Y/m/d", strtotime($transactions['date'])) . '</span>';
    }
        
    if ($templateVariables['date']) {
        $templateVariables['jfulldate'] = jdate("l ، j F Y", strtotime($templateVariables['date']));
    }
    
    $datefields = array(
        'expirydate',
        'duedate',
        'datepaid',
        'datedue',
        'nextduedate',
        'validuntil'
    );
    foreach ($datefields as $datefield) {
        if (strtotime($templateVariables[$datefield]) > 0)
            $templateVariables[$datefield] = '<span class="text-danger">' . date("Y/m/d", strtotime($templateVariables[$datefield])) . '&nbsp;(' . jdate("Y/m/d", strtotime($templateVariables[$datefield])) . ')</span>';
    }
    
    $datefields1 = array(
        'registrationdate',
        'datecreated',
        'regdate',
        'date'
    );
    foreach ($datefields1 as $datefield2) {
        if (strtotime($templateVariables[$datefield2]) > 0)
            $templateVariables[$datefield2] = '<span class="text-info">' . date("Y/m/d", strtotime($templateVariables[$datefield2])) . '&nbsp;(' . jdate("Y/m/d", strtotime($templateVariables[$datefield2])) . ')</span>';
    }
    
    //echo "<pre>";
    //print_r($templateVariables);
    //echo "</pre>";
    return $templateVariables;
});
// Product Details Jalali Date
add_hook('ClientAreaProductDetailsPreModuleTemplate', 1, function($templateVariables)
{
    
    if (!in_array($templateVariables["clientsdetails"]["language"], array(
        'farsi',
        'persian',
        'فارسی'
    )))
        return;
    
    $templateVariables['jdate'] = TRUE;
    $datefields = array(
        'nextduedate'
    );
    foreach ($datefields as $datefield) {
        if (strtotime($templateVariables[$datefield]) > 0)
            $templateVariables[$datefield] = '<span class="text-danger">' . date("Y/m/d", strtotime($templateVariables[$datefield])) . '&nbsp;(' . jdate("Y/m/d", strtotime($templateVariables[$datefield])) . ')</span>';
    }
    
    $datefields1 = array(
        'regdate'
    );
    foreach ($datefields1 as $datefield2) {
        if (strtotime($templateVariables[$datefield2]) > 0)
            $templateVariables[$datefield2] = '<span class="text-info">' . date("Y/m/d", strtotime($templateVariables[$datefield2])) . '&nbsp;(' . jdate("Y/m/d", strtotime($templateVariables[$datefield2])) . ')</span>';
    }
    
    $datefields2 = array(
        'lastupdate'
    );
    foreach ($datefields2 as $datefield3) {
        if (strtotime($templateVariables[$datefield3]) > 0)
            $templateVariables[$datefield3] = '<span class="text-info">' . date("Y/m/d H:i", strtotime($templateVariables[$datefield3])) . '&nbsp;(' . jdate("Y/m/d H:i", strtotime($templateVariables[$datefield3])) . ')</span>';
    }
    
    //echo "<pre>";
    //print_r($templateVariables);
    //echo "</pre>";
    return $templateVariables;
});
