<?php

set_include_path(get_include_path() . ':' . 'lib');

require_once 'Apache_AuthTkt.php';

$auth_tkt = new Apache_AuthTkt(array(
        'secret' => getenv('AUTH_TKT_SECRET'),
        'encrypt_data' => true,
    )
);
$tkt = $_COOKIE['statedemocrats_auth'];
$ip = '0.0.0.0';
$valid_tkt = $auth_tkt->validate_ticket($tkt, $ip);

print '<pre>';
if (!$valid_tkt) {
    print "Invalid ticket: $tkt\n";
    print $auth_tkt->get_err();
}
else {
    print_r($valid_tkt);
    print_r(json_decode($valid_tkt['data']));
}
print '</pre>';
